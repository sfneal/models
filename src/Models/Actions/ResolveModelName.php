<?php

namespace Sfneal\Models\Actions;

use Sfneal\Actions\Action;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\Helpers\Strings\StringHelpers;
use Sfneal\Models\Model;

class ResolveModelName extends Action
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var bool
     */
    private $short;

    /**
     * ResolveModelName constructor.
     *
     * @param Model $model
     * @param bool $short
     */
    public function __construct(Model $model, bool $short = true)
    {
        $this->model = $model;
        $this->short = $short;
    }

    /**
     * Retrieve the Model class's short name (without namespace).
     *
     * @return mixed
     */
    public function execute()
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
        return LaravelHelpers::getClassName($this->model, $this->short, $this->getTableCamelCase());
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
