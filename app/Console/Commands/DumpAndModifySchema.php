<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class DumpAndModifySchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schema:dump_modify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create MySql dump and change CREATE TABLE statements to CREATE TABLE IF NOT EXISTS.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $database = env('DB_DATABASE');
        Artisan::call('schema:dump');

        $dumpFilePath = database_path() . '/schema/mysql-schema.dump';
        if (file_exists($dumpFilePath)) {
            $dumpFile = file_get_contents($dumpFilePath);
            $newFile = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $dumpFile);
            Storage::disk('schema')->put('mysql-schema.dump', $newFile);
        }

        return 0;
    }
}
