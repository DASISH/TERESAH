<?php

class DataTypeObserver
{
    public function saving($dataType)
    {
        $dataType->slug = BaseHelper::generateSlug($dataType->label);
    }
}
