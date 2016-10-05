<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\Gallery;
use League\Fractal;

class GalleryTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'photos',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\Gallery $gallery
     * @return array
     */
    public function transform(Gallery $gallery)
    {
        return [
            'id' => (int) $gallery->id,
            'name' => $gallery->gallery_name,
            'description' => $gallery->gallery_description,
            'links' => [
                'thumbnail' => $gallery->thumbnail,
            ],
        ];
    }

    /**
     * Include Photos
     *
     * @param App\Models\Gallery            $gallery
     * @return League\Fractal\ItemResource
     */
    public function includePhotos(Gallery $gallery)
    {
        return $this
            ->collection($gallery->photos, new PhotoTransformer());
    }
}
