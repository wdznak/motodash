<?php

namespace App\Models;

use Auth;
use Config;
use App\Motodash\Facades\GraphicTransformer;

trait PhotoManager
{
    /**
     * Create and store photo with thumbnail
     *
     * @param  mixed $file
     * @return string
     */
    public function savePhotoWithThumbnail($file)
    {
        if(! $this->validateFile($file)) {
            return '';
        };

        return $this->createThumbnail($this->savePhoto($file));

    }

    /**
     * Validate file before saving
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function validateFile($file)
    {
        if(!$file || !$file->isValid()) {
            return '';
        }

        return true;
    }

    /**
     * Store photo in storage
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function savePhoto($file)
    {
        $fileName = $file->move(
                             storage_path('app/' . Config::get('motodash.userGallery') . Auth::id()),
                             str_slug('motodash' . ' ' . str_random(10))
                                 . '.' . $file->getClientOriginalExtension()
                         )
                         ->getFilename();

        return $fileName;
    }

    /**
     * Create thumbnail from request file
     *
     * @param  mixed $fileName
     * @return null
     */
    private function createThumbnail($fileName)
    {
        GraphicTransformer::makeThumbnail(
            Auth::id() . '/' . $fileName,
            'storage/gallery/' . Auth::id() . '/thumbnail-' . $fileName
        );

        return $fileName;
    }
}
