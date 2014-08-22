<?php

class ToolObserver
{
    public function saving($tool)
    {
        $tool->slug = BaseHelper::generateSlug($tool->name);
    }
}
