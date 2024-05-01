<?php

namespace Sfneal\Models\Tests\Feature\Models;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Framework\Attributes\Test;
use Sfneal\Models\Tests\Assets\Models\PeopleHard;
use Sfneal\Models\Tests\SeededTestCase;

class SoftDeletesIgnoredTest extends SeededTestCase
{
    #[Test]
    public function soft_deletes_scope_is_not_used()
    {
        $this->assertFalse(PeopleHard::hasGlobalScope(SoftDeletingScope::class));
    }

    #[Test]
    public function deleted_at_attribute_does_not_exist()
    {
        $model = PeopleHard::factory()->create();
        $this->assertFalse(property_exists($model, 'deleted_at'));
    }
}
