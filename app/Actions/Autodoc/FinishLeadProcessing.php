<?php

namespace App\Actions\Autodoc;

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

    public function handle(AutodocLead $lead)
    {
        $lead->update([
            'status' => SystemComponentStatus::Generated,
        ]);

        Notification::route('mail', $lead->email)
            ->notify(new DocumentationCompleted($lead));
        Notification::route('mail', $lead->email)
            ->notify(new FileRemoved($lead));
    }

    public function asCommand(Command $command)
    {
        $lead = AutodocLead::findOrFail($command->argument('lead'));
        $this->handle($lead);
    }
}
