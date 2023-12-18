<?php

namespace App\Console\Commands;

use App\Actions\Platform\ContentPlatforms\SynchronizeSystemComponent;
use App\Models\Branch;
use App\Models\SystemComponent;
use Illuminate\Console\Command;

class GenerateBranchInContentPlatforms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'codex:document-on-platforms {branchId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $branch = Branch::findOrFail($this->argument('branchId'));
        $branch->systemComponents()->each(function (SystemComponent $systemComponent) {
            SynchronizeSystemComponent::dispatch($systemComponent);
        });
    }
}
