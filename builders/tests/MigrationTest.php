<?php

namespace Sfneal\Builders\Tests;

use Sfneal\Builders\Tests\Models\People;

class MigrationTest extends TestCase
{
    /** @test */
    public function it_can_access_the_database()
    {
        // Save a new Address
        $person = new People();
        $person->name_first = 'Johnny';
        $person->name_last = 'Tsunami';
        $person->email = 'johnny.tsunami@example.com';
        $person->age = 22;
        $person->address = '123 Main Street';
        $person->city = 'Honolulu';
        $person->state = 'HI';
        $person->zip = '96795';
        $person->save();

        // Retrieve the new Address
        $newPerson = People::query()->find($person->person_id);

        // Assert Jokes are the same
        $this->assertSame($newPerson->name_first, 'Johnny');
        $this->assertSame($newPerson->name_last, 'Tsunami');
        $this->assertSame($newPerson->email, 'johnny.tsunami@example.com');
        $this->assertSame($newPerson->age, 22);
        $this->assertSame($newPerson->address, '123 Main Street');
        $this->assertSame($newPerson->city, 'Honolulu');
        $this->assertSame($newPerson->state, 'HI');
        $this->assertSame($newPerson->zip, '96795');
    }
}
