<?php


namespace Sfneal\Models\Tests\Assets\Builders;


use Sfneal\Builders\QueryBuilder;
use Sfneal\Builders\Traits\WhereBetweenSplitter;
use Sfneal\Builders\Traits\WherePublicStatus;

class PeopleBuilder extends QueryBuilder
{
    use WhereBetweenSplitter;
    use WherePublicStatus;
}
