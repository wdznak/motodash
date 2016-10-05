<?php

namespace App\Motodash\Contracts\Modules;

interface DataTransformer
{
    /**
     * Transform each item in the collection using the ArraySerializer
     *
     * @param  Illuminate\Database\Eloquent\Collection  $model
     * @param  Fractal\TransformerAbstract              $transformer
     * @param  array                                    $includes
     * @return array
     */
    public function transformCollection($model, $transformer, $includes = array());

    /**
     * Transform item from the collection using the ArraySerializer
     *
     * @param  Collection                   $item
     * @param  Fractal\TransformerAbstract  $transformer
     * @param  array                        $includes
     * @return array
     */
    public function transformItem($item, $transformer, array $includes = array());

    /**
     * Vehicles transformer, only for form.
     * Temporary, only for testing purposes.
     *
     * @param  array  $vehicles
     * @return string
     */
    public function transformVehicleForAjax(array $vehicles);
}
