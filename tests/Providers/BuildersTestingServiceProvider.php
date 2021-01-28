<?php

namespace Sfneal\Builders\Tests\Providers;

use Illuminate\Support\ServiceProvider;

class BuildersTestingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish migration file (if not already published)
        if (! class_exists('CreatePeopleTable')) {
            $this->publishes([
                __DIR__.'/../migrations/create_people_table.php.stub' => database_path(
                    'migrations/'.date('Y_m_d_His', time()).'_create_people_table.php'
                ),
            ], 'migration');
        }
    }
}
