<?php

namespace App\Actions\Platform;

use App\Models\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class RedirectToRepositoryPayment
{
    use AsAction;

    public function handle(Repository $repository)
    {
        /** @var \App\Models\User */
        $user = request()->user();
        /** @var \App\Models\Team */
        $team = $repository->project->team;

        abort_if($repository->paid(), 403, 'Repository already paid');
        abort_if($team->isNot($user->currentTeam), 403, 'You are not allowed to pay for this repository');

        $price = \App\Cashier\StripePlanProvider::price(config('spark.billables.user.price'));
        $session = $team->checkout([
            $price->id => 1,
        ], [
            'metadata' => [
                'repository_id' => $repository->id,
            ],
            'allow_promotion_codes' => true,
            'success_url' => route('projects.show', $repository->project),
            'cancel_url' => route('projects.show', $repository->project),
        ]);

        return redirect($session->url);
    }
}
