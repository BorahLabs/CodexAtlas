<?php

namespace App\Actions\Autodoc;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\AutodocLead;
use App\Notifications\Autodoc\PurchaseCompleted;
use Illuminate\Support\Facades\Notification;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleStripeWebhook
{
    use AsAction;

    public function handle()
    {
        logger(request()->all());
        $event = \Stripe\Webhook::constructEvent(request()->getContent(), request()->header('stripe-signature'), config('autodoc.stripe.webhook_secret'));
        if ($event->type === 'checkout.session.completed') {
            $lead = AutodocLead::findOrFail($event->data->object->metadata['autodoc_lead_id']);
            $lead->update([
                'status' => 'processing',
            ]);

            Notification::route('mail', $lead->email)->notify(new PurchaseCompleted($lead));
            LogUserPerformedAction::dispatch(\App\Enums\Platform::AutomaticDocs, \App\Enums\NotificationType::Success, 'Purchase completed', [
                'lead' => $lead->id,
                'email' => $lead->email,
            ]);
            ProcessLead::dispatch($lead);
        }

        return response()->json(['success' => true]);
    }

    public function asController()
    {
        return $this->handle();
    }
}
