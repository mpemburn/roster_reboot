<?php

use App\Models\Wheel;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class SeedWheelsTable extends Migration
{
    use ImportSeederCsv;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('wheels')) {
            $data = $this->getCsv('database/data/wheels.csv');
            $data->each(static function ($row) {
                Wheel::create($row->toArray());
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('wheels')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Wheel::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
