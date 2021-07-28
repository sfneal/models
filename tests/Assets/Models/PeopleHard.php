<?php

namespace Sfneal\Models\Tests\Assets\Models;

use Sfneal\Models\Traits\SoftDeletesIgnored;

class PeopleHard extends People
{
    use SoftDeletesIgnored;

    protected $table = 'people_hard';
}
