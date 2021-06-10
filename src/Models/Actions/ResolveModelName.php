<?php

namespace Sfneal\Models\Actions;

use Sfneal\Actions\Action;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\Helpers\Strings\StringHelpers;
use Sfneal\Models\Model;

class ResolveModelName extends Action
{
    /**
     * @var Model|string
     */
    private $model;

    /**
     * @var bool
     */
    private $short;

    /**
     * ResolveModelName constructor.
     *
     * @param Model|string $model
     * @param bool $short
     */
    public function __construct($model, bool $short = true)
    {
        $this->model = $model;
        $this->short = $short;
    }

    /**
     * Retrieve the Model class's short name (without namespace).
     *
     * @return string
     */
    public function execute(): string
    {
        // Split string on upper case characters
        return implode(' ', (new StringHelpers($this->getClassName()))->camelCaseSplit());
    }

    /**
     * Retrieve the name from the Model's class name or the table name.
     *
     * @return string
     */
    private function getClassName(): string
    {
        return LaravelHelpers::getClassName(
            $this->model,
            $this->short,
            ! is_string($this->model) ? $this->getTableCamelCase() : null
        );
    }

    /**
     * Convert table name to a CamelCase string for consistency with Model names.
     *
     * @return string
     */
    private function getTableCamelCase(): string
    {
        return implode(
            '',
            array_map(
                function (string $piece) {
                    return ucfirst($piece);
                },
                explode('_', $this->model->getTable())
            )
        );
    }
}
