<?php

namespace Sfneal\Models;

use Sfneal\Models\Interfaces\IsPublicInterface;
use Sfneal\Models\Interfaces\UpdatePublicStatusInterface;
use Sfneal\Models\Traits\PublicStatusTrait;

abstract class AbstractModelWithPublicStatus extends AbstractModel implements IsPublicInterface, UpdatePublicStatusInterface
{
    use PublicStatusTrait;
}
