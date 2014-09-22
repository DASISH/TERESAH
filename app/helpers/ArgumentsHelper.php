<?php

class ArgumentsHelper
{
    public static function addKeyValue($key, $value) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments)){
            $arguments[$key] = $arguments[$key].",".$value;
        } else {
            $arguments[$key] = $value;
        }
        return $arguments;
    }
 
    public static function removeKeyValue($key, $value) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments)){
            if($arguments[$key] == $value){
                unset($arguments[$key]);
            } else if(strpos(urldecode($arguments[$key]), ',') !== FALSE){
                $values = explode(',', urldecode($arguments[$key]));
                if(($index = array_search($value, $values)) !== false) {
                    unset($values[$index]);
                    $arguments[$key] = implode(',', $values);
                }
            }
            
        }
        return $arguments;
    }    
    
    public static function keyValueActive($key, $value) {
        $arguments = Input::all();
        if(array_key_exists($key, $arguments)){
            $values = explode(",", $arguments[$key]);
            return in_array($value, $values);
        } 
        return false;
    }    
}
            