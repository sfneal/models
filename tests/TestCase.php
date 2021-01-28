<?php

namespace Sfneal\Builders\Tests;

use Illuminate\Database\Eloquent\Collection;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Builders\Tests\Models\People;

class TestCase extends OrchestraTestCase
{
    /**
     * @var People|Collection
     */
    public $models;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Create model factories
        $this->models = People::factory()
            ->count(20)
            ->make();

        // Add custom factories
        $this->addCustomFactories();
    }

    /**
     * Add custom Factories to the model Collection
     *
     * @return array
     */
    private static function customFactories(): array
    {
        return [
            People::factory()->make([
                'name_first' => 'Stephen',
                'name_last' => 'Neal',
            ]),
            People::factory()->make([
                'name_first' => 'Richard',
                'name_last' => 'Neal',
            ])
        ];
    }

    /**
     * Add custom factories to the Model Collection
     *
     * @return void
     */
    private function addCustomFactories(): void
    {
        foreach (self::customFactories() as $factory) {
            $this->models->add($factory);
        }
    }
}
