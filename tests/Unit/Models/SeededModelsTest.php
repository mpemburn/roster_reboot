<?php

namespace Tests\Unit\Models;

use App\Models\Element;
use App\Models\LeadershipRole;
use App\Models\SecurityQuestion;
use App\Models\State;
use App\Models\Wheel;
use App\Traits\ImportSeederCsv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Tests\TestCase;

class SeededModelsTest extends TestCase
{
    use ImportSeederCsv;

    public function testStatesModel(): void
    {
        $state = new State();
        $seed = $this->getRandomSeedValue($state);

        $this->doAssertions($seed, $state);
    }

    public function testElementsModel(): void
    {
        $element = new Element();
        $seed = $this->getRandomSeedValue($element);

        $this->doAssertions($seed, $element);
    }

    public function testWheelsModel(): void
    {
        $wheel = new Wheel();
        $seed = $this->getRandomSeedValue($wheel);

        $this->doAssertions($seed, $wheel);
    }

    public function testLeadershipRoleModel(): void
    {
        $role = new LeadershipRole();
        $seed = $this->getRandomSeedValue($role);

        $this->doAssertions($seed, $role);
    }

    public function testSecurityQuestionModel(): void
    {
        $question = new SecurityQuestion();
        $seed = $this->getRandomSeedValue($question);

        $this->doAssertions($seed, $question);
    }

    protected function getRandomSeedValue(Model $model): ?Collection
    {
        $seeds = $this->getCsv(base_path() . "/database/data/{$model->getTable()}.csv");

        return $seeds->isNotEmpty() ? $seeds->random() : null;
    }

    protected function doAssertions(Collection $seed, Model $model): void
    {
        $seed->each(static function ($value, $key) use ($model) {
            $result = $model->query()->where($key, '=', $value);
            $instance = $result->first();

            if ($instance) {
                self::assertEquals($value, $instance->$key);
            }
        });
    }
}
