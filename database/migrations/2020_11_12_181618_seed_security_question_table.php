<?php

use App\Models\SecurityQuestion;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedSecurityQuestionTable extends Migration
{
    use ImportSeederCsv;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable('security_questions')) {
            $data = $this->getCsv('./database/data/security_questions.csv');
            $data->each(static function ($row) {
                SecurityQuestion::create($row->toArray());
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
        if (Schema::hasTable('security_questions')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            SecurityQuestion::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
