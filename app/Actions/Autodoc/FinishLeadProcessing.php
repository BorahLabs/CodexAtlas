<?php

namespace App\Actions\Autodoc;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Enums\SystemComponentStatus;
use App\Models\AutodocLead;
use App\Notifications\Autodoc\DocumentationCompleted;
use App\Notifications\Autodoc\FileRemoved;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Lorisleiva\Actions\Concerns\AsAction;

class FinishLeadProcessing
{
    use AsAction;

    public string $commandSignature = 'autodoc:finish-lead {lead}';

    public function handle(AutodocLead $lead): void
    {
        $lead->update([
            'status' => SystemComponentStatus::Generated,
        ]);

        Notification::route('mail', $lead->email)
            ->notify(new DocumentationCompleted($lead));
        Notification::route('mail', $lead->email)
            ->notify(new FileRemoved($lead));
        LogUserPerformedAction::dispatch(\App\Enums\Platform::AutomaticDocs, \App\Enums\NotificationType::Success, 'Lead finished processing', [
            'lead' => $lead->id,
        ]);
    }

    public function asCommand(Command $command): void
    {
        $lead = AutodocLead::findOrFail($command->argument('lead'));
        $this->handle($lead);
    }
}
