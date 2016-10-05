<?php

namespace App\Motodash\Contracts\Modules;

interface GraphicTransformer
{
    /**
     * Create thumbnail
     *
     * @param  string $filePath
     * @param  string $fileName
     * @return void
     */
    public function makeThumbnail($filePath, $fileName);
}
