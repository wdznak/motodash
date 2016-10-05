<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Motodash\Contracts\Modules\DataTransformer;
use Spatie\Fractal\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class FractalDataTransformer implements DataTransformer
{

    /**
     * Transform each item in the collection using the ArraySerializer
     *
     * @param  Illuminate\Database\Eloquent\Collection  $model
     * @param  Fractal\TransformerAbstract              $transformer
     * @param  array                                    $includes
     * @return array
     */
    public function transformCollection($model, $transformer, $includes = array())
    {
        return fractal()
            ->collection($model)
            ->transformWith(new $transformer)
            ->parseIncludes($includes)
            ->serializeWith(new ArraySerializer())
            ->toArray();
    }

    /**
     * Transform item from the collection using the ArraySerializer
     *
     * @param  Collection                   $item
     * @param  Fractal\TransformerAbstract  $transformer
     * @param  array                        $includes
     * @return array
     */
    public function transformItem($item, $transformer, array $includes = array())
    {
        return fractal()
            ->item($item)
            ->transformWith(new $transformer)
            ->parseIncludes($includes)
            ->serializeWith(new ArraySerializer())
            ->toArray();
    }

    /**
     * Vehicles transformer, only for form.
     * Temporary, only for testing purposes.
     *
     * @param  array  $vehicles
     * @return string
     */
    public function transformVehicleForAjax(array $vehicles)
    {
        $types = array();
        $brands = array();
        $models = array();
        $years = array();

        foreach ($vehicles as $value) {
            if (!in_array($value['type'], $types)) {
                $types[$value['type']] = array(
                    'type' => $value['type']
                );
            }

            if(!array_key_exists($value['brand'], $brands)) {
                $brands[$value['brand']] = array(
                    'type' => $value['type'],
                    'brand' => $value['brand']
                );
            }

            if(!array_key_exists($value['model'], $models)) {
                $models[$value['model']] = array(
                    'brand' => $value['brand'],
                    'model' => $value['model'],
                );
            }

            $years[$value['id']] = array(
                'id' => $value['id'],
                'model' => $value['model'],
                'produced' => $value['produced_from'] . '-' . $value['produced_to']
            );

        }

        return json_encode(compact('types', 'brands', 'models', 'years', 'vehicles'));
    }
}
