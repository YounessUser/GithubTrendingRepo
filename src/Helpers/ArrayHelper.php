<?php

namespace App\Helpers;


class ArrayHelper
{
    /**
     * group array of object by property if exist if not group by $default value
     *
     * @param $arrayObjs
     * @param $propperty
     * @param $default
     * @return array
     */
    public function groupByProperty($arrayObjs, $propperty, $default){
        $result = [];
        foreach ($arrayObjs as $obj){
            $key = ($obj[$propperty] != null) ? $obj[$propperty] : $default;
            $result[$key][] = $obj;
        }
        return $result;
    }
}