<?php

namespace Yajra\Datatables\Html;

use Illuminate\Support\Fluent;

/**
 * Class Column.
 *
 * @package Yajra\Datatables\Html
 * @property string data
 * @property string name
 * @property string orderable
 * @property string searchable
 * @property string printable
 * @property string exportable
 * @property string footer
 * @property array  attributes
 * @see     https://datatables.net/reference/option/ for possible columns option
 * @author  Arjay Angeles <aqangeles@gmail.com>
 */
class Column extends Fluent
{
    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $attributes['orderable']  = isset($attributes['orderable']) ? $attributes['orderable'] : true;
        $attributes['searchable'] = isset($attributes['searchable']) ? $attributes['searchable'] : true;
        $attributes['exportable'] = isset($attributes['exportable']) ? $attributes['exportable'] : true;
        $attributes['printable']  = isset($attributes['printable']) ? $attributes['printable'] : true;
        $attributes['footer']     = isset($attributes['footer']) ? $attributes['footer'] : '';
        $attributes['attributes'] = isset($attributes['attributes']) ? $attributes['attributes'] : [];

        // Allow methods override attribute value
        foreach ($attributes as $attribute => $value) {
            $method = 'parse' . ucfirst(strtolower($attribute));
            if (method_exists($this, $method)) {
                $attributes[$attribute] = $this->$method($value);
            }
        }

        parent::__construct($attributes);
    }

    /**
     * Parse render attribute.
     *
     * @param mixed $value
     * @return string|null
     */
    public function parseRender($value)
    {
        /** @var \Illuminate\Contracts\View\Factory $view */
        $view       = app('view');
        $parameters = [];

        if (is_array($value)) {
            $parameters = array_except($value, 0);
            $value      = $value[0];
        }

        if (is_callable($value)) {
            return $value($parameters);
        } elseif ($view->exists($value)) {
            return $view->make($value)->with($parameters)->render();
        }

        return $value ? $this->parseRenderAsString($value) : null;
    }

    /**
     * Display render value as is.
     *
     * @param mixed $value
     * @return string
     */
    private function parseRenderAsString($value)
    {
        return "function(data,type,full,meta){return $value;}";
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_except($this->attributes, ['printable', 'exportable', 'footer']);
    }
}
