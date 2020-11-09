<?php

use App\Models\Element;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class SeedElementsTable extends Migration
{
    use ImportSeederCsv;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable('elements')) {
            $data = $this->getCsv('database/data/elements.csv');
            $data->each(static function ($row) {
                Element::create($row->toArray());
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
        if (Schema::hasTable('elements')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Element::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
