<?php

use App\Models\LeadershipRole;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedLeadershipRoleTable extends Migration
{
    use ImportSeederCsv;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasTable('leadership_roles')) {
            $data = $this->getCsv('./database/data/leadership_roles.csv');
            $data->each(static function ($row) {
                LeadershipRole::create($row->toArray());
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
        if (Schema::hasTable('leadership_roles')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            LeadershipRole::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
