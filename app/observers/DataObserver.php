<?php

class DataObserver
{
    public function saving($data)
    {
        if(strlen($data->value) > 255 || $data->linkable == false){
            $data->slug = hash('md5', $data->value);
        } else {
            $data->slug = BaseHelper::generateSlug($data->value);
        }
    }
}
