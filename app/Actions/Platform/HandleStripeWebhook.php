<?php

namespace App\Actions\Platform;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\Repository;
use App\Notifications\Codex\PurchaseCompleted;
use App\SourceCode\DTO\Branch as DTOBranch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleStripeWebhook
{
    use AsAction;

    public function handle()
    {
        $event = \Stripe\Webhook::constructEvent(request()->getContent(), request()->header('stripe-signature'), config('cashier.webhook.secret'));
        if ($event->type !== 'checkout.session.completed') {
            return response()->json(['success' => true]);
        }

        /** @var Repository $repository */
        $repository = Repository::findOrFail($event->data->object->metadata['repository_id']);
        $repository->payments()->create([
            'stripe_id' => $event->data->object->id,
        ]);

        $ownerEmail = $repository->project->team->owner->email;
        Notification::route('mail', $ownerEmail)->notify(new PurchaseCompleted($repository));
        LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Success, 'Purchase completed', [
            'repository' => $repository->id,
            'team' => $repository->project->team->id,
            'owner_email' => $ownerEmail,
        ]);

        if ($repository->branches->isEmpty()) {
            /** @var \App\Models\SourceCodeAccount $sourceCodeAccount */
            $sourceCodeAccount = $repository->sourceCodeAccount;
            $branches = $sourceCodeAccount->getProvider()->branches($repository->nameDto());
            $whitelist = ['main', 'master', 'production', 'prod', 'release', 'dev', 'develop', 'staging'];
            /**
             * @var \App\Enums\SubscriptionType $subscriptionType
             */
            $subscriptionType = $repository->project->team->subscriptionType();

            $collectedBranches = collect($branches)
                ->filter(fn (DTOBranch $branch) => in_array($branch->name, $whitelist));

            if ($collectedBranches->isEmpty() && isset($branches[0])) {
                $collectedBranches = collect([$branches[0]]);
            }

            $collectedBranches
                ->values()
                ->when(! is_null($subscriptionType->maxBranchesPerRepository()), fn (Collection $branches) => $branches->take($subscriptionType->maxBranchesPerRepository()))
                ->each(fn (DTOBranch $branch) => $repository->branches()->create([
                    'name' => $branch->name,
                ]));
        }

        return response()->json(['success' => true]);
    }
}
