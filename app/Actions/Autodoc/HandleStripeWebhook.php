<?php

namespace App\Actions\Autodoc;

use App\Models\AutodocLead;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleStripeWebhook
{
    use AsAction;

    public function handle()
    {
        $event = \Stripe\Webhook::constructEvent(request()->getContent(), request()->header('stripe-signature'), config('autodoc.stripe.webhook_secret'));
        if ($event->type === 'checkout.session.completed') {
            $lead = AutodocLead::findOrFail($event->data->object->metadata['autodoc_lead_id']);
            $lead->update([
                'status' => 'processing',
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
