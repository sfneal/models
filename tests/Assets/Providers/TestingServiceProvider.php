<?php

namespace Sfneal\Models\Tests\Assets\Providers;

use Illuminate\Support\ServiceProvider;

class TestingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish migration file (if not already published)
        if (! class_exists('CreatePeopleTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_people_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'_create_people_table.php'
                ),
            ], 'migration');
        }

        // Publish migration file (if not already published)
        if (! class_exists('CreatePeopleHardTable')) {
            $this->publishes([
                __DIR__ . '/../../database/migrations/create_people_hard_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'create_people_hard_table.php'
                ),
            ], 'migration');
        }
    }
}
