<?php

namespace Sfneal\Models\Tests\Feature\Models;

use PHPUnit\Framework\Attributes\Test;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\SeededTestCase;

class ModelWithPublicStatusTest extends SeededTestCase
{
    #[Test]
    public function isPublic()
    {
        People::query()
            ->where('public_status', '=', 1)
            ->get()
            ->each(function (People $people) {
                $this->assertTrue($people->isPublic());
            });
    }

    #[Test]
    public function isPrivate()
    {
        People::query()
            ->where('public_status', '=', 0)
            ->get()
            ->each(function (People $people) {
                $this->assertTrue($people->isPrivate());
            });
    }

    #[Test]
    public function updatePublicStatus()
    {
        $model = People::factory()->create(['public_status' => null]);
        $this->assertNull($model->public_status);

        $model->updatePublicStatus(1);
        $this->assertTrue($model->isPublic());

        $model->updatePublicStatus(10);
        $this->assertTrue($model->isPrivate());
    }
}
