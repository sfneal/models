<?php

namespace Sfneal\Builders\Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Builders\Tests\Models\People;
use Sfneal\Builders\Tests\Providers\BuildersTestingServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * @var People|Collection
     */
    public $models;

    protected function getPackageProviders($app)
    {
        return BuildersTestingServiceProvider::class;
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__.'/migrations/create_people_table.php.stub';

        (new \CreatePeopleTable())->up();
    }

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
            ]),
            People::factory()->create([
                'name_first' => 'Richard',
                'name_last' => 'Neal',
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
