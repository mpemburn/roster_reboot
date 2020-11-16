<?php

namespace Tests\Unit\Models;

use App\Models\Element;
use App\Models\LeadershipRole;
use App\Models\Prefix;
use App\Models\SecurityQuestion;
use App\Models\State;
use App\Models\Suffix;
use App\Models\Wheel;
use App\Traits\ImportSeederCsv;
use Illuminate\Support\Collection;
use Tests\TestCase;

class SeededModelsTest extends TestCase
{
    use ImportSeederCsv;

    public function setUp(): void
    {
        parent::setUp();
        // Do artisan migrate:refresh on test database
        $this->refreshDatabase();
    }

    public function testElementsModel(): void
    {
        $seeds = $this->seedTable(Element::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, Element::class);
    }

    public function testLeadershipRoleModel(): void
    {
        $seeds = $this->seedTable(LeadershipRole::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, LeadershipRole::class);
    }

    public function testPrefixesModel(): void
    {
        $seeds = $this->seedTable(Prefix::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, Prefix::class);
    }

    public function testSecurityQuestionModel(): void
    {
        $seeds = $this->seedTable(SecurityQuestion::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, SecurityQuestion::class);
    }

    public function testStatesModel(): void
    {
        $seeds = $this->seedTable(State::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, State::class);
    }

    public function testSuffixModel(): void
    {
        $seeds = $this->seedTable(Suffix::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, Suffix::class);
    }

    public function testWheelsModel(): void
    {
        $seeds = $this->seedTable(Wheel::class);
        $seed = $this->getRandomSeedValue($seeds);

        $this->doAssertions($seed, Wheel::class);
    }

    protected function seedTable(string $className): Collection
    {
        $model = new $className();
        $table = $model->getTable();

        // Get a collection of the lines from the CSV for this table
        $seeds = $this->getCsv(base_path() . "/database/data/{$table}.csv");
        $seeds->each(static function ($seed) use ($className) {
            $model = new $className($seed->toArray());
            $model->save();
        });

        $all = $model->all();
        self::assertEquals($seeds->count(), $all->count());

        return $seeds;
    }

    protected function getRandomSeedValue(Collection $seeds): ?Collection
    {
        return $seeds->isNotEmpty() ? $seeds->random() : null;
    }

    protected function doAssertions(Collection $seed, string $className): void
    {
        $model = new $className();
        $seed->each(static function ($value, $property) use ($model) {
            $result = $model->query()->where($property, '=', $value);
            $instance = $result->first();

            if ($instance) {
                // ->$property references the Model's property
                self::assertEquals($value, $instance->$property);
            }
        });
    }
}
