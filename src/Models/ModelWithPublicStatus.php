<?php

namespace Sfneal\Models;

use Sfneal\Models\Interfaces\IsPublicInterface;
use Sfneal\Models\Traits\PublicStatusTrait;

abstract class ModelWithPublicStatus extends Model implements IsPublicInterface
{
    use PublicStatusTrait;
}
