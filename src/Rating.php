<?php

namespace NovaField\Rating;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Rating extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'rating';


    /**
     * @var int
     */
    protected $max;

    /**
     * @var int
     */
    protected $min;

    /**
     * Rating constructor.
     * @param int $max
     */
    public function __construct($name, int $max, int $min = 1, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->min($min);
        $this->max($max);



        $this->rules(function (NovaRequest $request) {
            return [
                'integer',
                'min:' . $this->min,
                'max:' . $this->max,
            ];
        });
    }

    public function min(int $min) {
        $this->min = $min;
        $this->withMeta(['min' => $min]);
    }


    public function max(int $max)
    {
        $this->max = $max;

        return $this->withMeta(['max' => $max]);
    }


}
