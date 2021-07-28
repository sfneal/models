<?php

namespace Sfneal\Models\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Models\Tests\Assets\Providers\TestingServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Register package service providers.
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            TestingServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/database/migrations/create_people_table.php.stub';
        (new \CreatePeopleTable())->up();
        (new \CreatePeopleTable('people_hard', false))->up();
    }
}
