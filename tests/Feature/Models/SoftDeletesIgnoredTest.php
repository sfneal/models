<?php

namespace Sfneal\Models\Tests\Feature\Models;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Sfneal\Models\Tests\Assets\Models\PeopleHard;
use Sfneal\Models\Tests\SeededTestCase;

class SoftDeletesIgnoredTest extends SeededTestCase
{
    /** @test */
    public function soft_deletes_scope_is_not_used()
    {
        $this->assertFalse(PeopleHard::hasGlobalScope(SoftDeletingScope::class));
    }

    /** @test */
    public function deleted_at_attribute_does_not_exist()
    {
        $model = PeopleHard::factory()->create();
        $this->assertFalse(property_exists($model, 'deleted_at'));
    }
}
