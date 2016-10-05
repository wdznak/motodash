<?php

namespace App\Motodash\Facades;

use Illuminate\Support\Facades\Facade;

class GraphicTransformer extends Facade
{
    protected static function getFacadeAccessor() {
        return 'App\Motodash\Modules\GraphicTransformer\GlideTransformer';
    }
}
