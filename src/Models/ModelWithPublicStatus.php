<?php

namespace Sfneal\Models;

use Sfneal\Models\Interfaces\IsPublicInterface;
use Sfneal\Models\Interfaces\UpdatePublicStatusInterface;
use Sfneal\Models\Traits\PublicStatusTrait;

/**
 * class ModelWithPublicStatus.
 *
 * @property int $public_status
 */
#[\AllowDynamicProperties]
abstract class ModelWithPublicStatus extends Model implements IsPublicInterface, UpdatePublicStatusInterface
{
    use PublicStatusTrait;
}
