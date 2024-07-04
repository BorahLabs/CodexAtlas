<?php

namespace App\Console\Commands\Codex;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// @codeCoverageIgnoreStart
class ResetPostgresSequences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:reset-pg-seq';

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
        $tables = Schema::getTableListing();
        foreach ($tables as $table) {
            $this->info("Resetting sequence for $table");
            try {
                DB::statement("SELECT SETVAL('{$table}_id_seq', (SELECT MAX(id) FROM $table))");
            } catch (\Exception $e) {
                $this->warn($e->getMessage());
            }
        }
    }
}
