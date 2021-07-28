<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Sfneal\Models\Tests\Assets\Models\People;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Models from factories
        People::factory()
            ->count(20)
            ->create();

        // Add custom factories
        People::factory()->create([
            'name_first' => 'Stephen',
            'name_last' => 'Neal',
            'address' => '72 Ice House Lane',
            'city' => 'Franklin',
            'state' => 'MA',
            'zip' => '02038',
        ]);
        People::factory()->create([
            'name_first' => 'Richard',
            'name_last' => 'Neal',
            'address' => '75 Ice House Lane',
            'city' => 'Franklin',
            'state' => 'MA',
            'zip' => '02038',
        ]);
    }
}
