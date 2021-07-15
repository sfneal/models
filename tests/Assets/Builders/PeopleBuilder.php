<?php


namespace Sfneal\Models\Tests\Assets\Builders;


use Sfneal\Builders\QueryBuilder;
use Sfneal\Builders\Traits\WhereBetweenSplitter;

class PeopleBuilder extends QueryBuilder
{
    use WhereBetweenSplitter;
}
