<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

trait MigrateFreshSeedOnce
{
    /**
     * If true, setup has run at least once.
     * @var boolean
     */
    protected static $setUpHasRunOnce = false;
    /**
     * After the first run of setUp "migrate:fresh --seed"
     * @return void
     */
    public function migrate(): void
    {
//        parent::setUp();
        if (!static::$setUpHasRunOnce) {
            Artisan::call('schema:dump_sqlite');
            Artisan::call('migrate:fresh');
            Artisan::call(
                'db:seed', ['--class' => 'DatabaseSeeder']
            );
            static::$setUpHasRunOnce = true;
        }
    }

}
