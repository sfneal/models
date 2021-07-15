<?php

namespace Sfneal\Models\Tests;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Models\Tests\Assets\Models\People;

class BuilderTestCase extends TestCase
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
            ->create();

        // Add custom factories
        $this->addCustomFactories();
    }

    /**
     * Add custom Factories to the model Collection.
     *
     * @return array
     */
    private static function customFactories(): array
    {
        return [
            People::factory()->create([
                'name_first' => 'Stephen',
                'name_last' => 'Neal',
                'address' => '72 Ice House Lane',
                'city' => 'Franklin',
                'state' => 'MA',
                'zip' => '02038',
            ]),
            People::factory()->create([
                'name_first' => 'Richard',
                'name_last' => 'Neal',
                'address' => '75 Ice House Lane',
                'city' => 'Franklin',
                'state' => 'MA',
                'zip' => '02038',
            ]),
        ];
    }

    /**
     * Add custom factories to the Model Collection.
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
