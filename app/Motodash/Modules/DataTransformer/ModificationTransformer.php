<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\Modification;
use League\Fractal;

class ModificationTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\Modification $modification
     * @return array
     */
    public function transform(Modification $modification)
    {
        return [
            'id' => (int) $modification->id,
            'name' => $modification->mod_name,
            'description' => $modification->value,
            'price' => (float) $modification->price,
        ];
    }
}
