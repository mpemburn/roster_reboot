<?php

use App\Models\Prefix;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedPrefixesTable extends Migration
{
    use ImportSeederCsv;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable('prefixes')) {
            $data = $this->getCsv('./database/data/prefixes.csv');
            $data->each(static function ($row) {
                Prefix::create($row->toArray());
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasTable('prefixes')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Prefix::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
