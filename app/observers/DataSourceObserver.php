<?php

class DataSourceObserver
{
    public function saving($dataType)
    {
        $dataType->slug = BaseHelper::generateSlug($dataType->name);
    }
}
