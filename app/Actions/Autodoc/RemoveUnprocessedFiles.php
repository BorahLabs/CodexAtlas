<?php

namespace App\Actions\Autodoc;

use App\Models\AutodocLead;
use App\Notifications\Autodoc\FileRemoved;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class RemoveUnprocessedFiles
{
    use AsAction;

    public string $commandSignature = 'autodoc:remove-unprocessed-files';

    public function handle()
    {
        AutodocLead::query()
            ->where('status', 'pending')
            ->whereNotNull('zip_path')
            ->where('created_at', '<', now()->subHours(2))
            ->each(function (AutodocLead $lead) {
                $disk = Storage::disk('s3');
                if ($disk->exists($lead->zip_path)) {
                    $disk->delete($lead->zip_path);

                    Notification::route('mail', $lead->email)
                        ->notify(new FileRemoved($lead));
                }

                $lead->update([
                    'status' => 'deleted',
                ]);
            });
    }
}
