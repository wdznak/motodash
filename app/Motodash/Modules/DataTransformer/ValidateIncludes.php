<?php

namespace App\Motodash\Modules\DataTransformer;

trait ValidateIncludes
{
    public function findMatchingRelation($collection, $key)
    {
        $keys = array_keys($collection['relations']);
        $result = preg_grep('/'.$key.'/i', $keys);

        if(count($result) !== 1) {
            throw new \Exception(
                sprintf("Invalid numbers of arguments in %s. Expected 1, received %s", $key, count($result))
            );
        }

        return $result[0];
    }
}
