<?php

namespace App\Motodash\Modules\GraphicTransformer;

use App\Motodash\Contracts\Modules\GraphicTransformer;
use Spatie\Glide\GlideImage;


class GlideTransformer implements GraphicTransformer
{
    /**
     * Glide instance
     *
     * @var Spatie\Glide\GlideImage $glide
     */
    protected $glide;

    /**
     * @param Spatie\Glide\GlideImage $glide
     */
    function __construct(GlideImage $glide)
    {
        $this->glide = $glide;
    }

    /**
     * Create thumbnail
     *
     * @param  string $filePath
     * @param  string $fileName
     * @return void
     */
    public function makeThumbnail($filePath, $fileName)
    {
        return $this->glide
                    ->load($filePath)
                    ->modify(['fit' => 'crop', 'w' => 100, 'h' => 100])
                    ->save($fileName);
    }
}
