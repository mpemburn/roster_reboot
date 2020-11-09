<?php

use App\Models\State;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedStatesTable extends Migration
{
    use ImportSeederCsv;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable('states')) {
            $data = $this->getCsv('./database/data/states.csv');
            $data->each(static function ($row) {
                State::create($row->toArray());
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
        if (Schema::hasTable('states')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            State::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
