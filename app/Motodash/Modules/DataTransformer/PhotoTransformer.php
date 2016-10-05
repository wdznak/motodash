<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\Photo;
use League\Fractal;

class PhotoTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\Photo $photo
     * @return array
     */
    public function transform(Photo $photo)
    {
        return [
            'id' => (int) $photo->id,
            'description' => $photo->description,
            'links' => [
                'photo' => $photo->path,
            ],
        ];
    }
}
