<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/7/19
 * Time: 09:58
 */

function pp($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

function getArray($array, $index) {
    if (!is_array($array)) return null;
    if (isset($array[$index])) return $array[$index];
    foreach ($array as $item) {
        $return = getArray($item, $index);
        if (!is_null($return)) {
            return $return;
        }
    }
    return null;
}