<?php

namespace Ozdemir\Datatables;

/**
 * Class Column
 *
 * @package Ozdemir\Datatables
 */
class Column
{
    /**
     * Column name
     *
     * @var
     */
    public $name;

    /**
     * Column visibility
     *
     * @var bool
     */
    public $hidden = false;

    /**
     * Callback function
     *
     * @var callable
     */
    public $closure;

    /**
     * @var array
     */
    public $attr;

    /**
     * @var bool
     */
    public $interaction = true;

    /**
     * Custom filter
     * @var callable
     */
    public $customFilter;

    /**
     * Column constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param $row array
     * @return string
     */
    public function value($row): ?string
    {
        if ($this->closure) {
            $closure = $this->closure;

            return $closure($row);
        }

        return $row[$this->name];
    }

    /**
     * Set visibility of the column.
     */
    public function hide(): void
    {
        $this->hidden = true;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return ($this->interaction && $this->attr['searchable']);
    }

    /**
     * @return bool
     */
    public function isOrderable(): bool
    {
        return ($this->interaction && $this->attr['orderable']);
    }

    /**
     * @return string
     */
    public function data(): string
    {
        return $this->attr['data'] ?? '';
    }

    /**
     * @return string
     */
    public function searchValue(): string
    {
        return $this->attr['search']['value'];
    }
}