<?php

class ToolObserver
{
    public function saving($tool)
    {
        $tool->slug = Tool::generateSlug($tool->name);
    }
}
