<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class CreateSqliteSchemaDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schema:dump_sqlite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create MySql dump and convert it to Sqlite format';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        $excludedTables = collect([
            'failed_jobs',
            'oauth_auth_codes',
            'oauth_clients',
            'oauth_access_tokens',
            'oauth_personal_access_clients',
            'oauth_refresh_tokens'
        ])->map(static function ($item) use ($database) {
            return " --ignore-table=$database.$item";
        })->implode('');

        $process = new Process([
            base_path() . '/mysql2sqlite.sh',
            $database,
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            $excludedTables
        ]);

        $process->run();

        $output = $process->getOutput();

        $output = $this->massageOutput($output);

        Storage::disk('schema')->put('sqlite_testing-schema.dump', $output);

        return 0;
    }

    protected function massageOutput(string $output): string
    {
        $massaged = preg_replace('/(CONSTRAINT)(.*)/', '', $output);
        $massaged = preg_replace('/("id" )(bigint\(20\) )( NOT NULL )(,)/', '$1$2$4', $massaged);
        $massaged = preg_replace('/("id" )(int\(10\) )( NOT NULL )(,)/', '$1$2$4', $massaged);

        return $massaged;
    }
}
