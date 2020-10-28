<?php

namespace App\Features\Task\Http\Resources;

class TaskResource
{
    /**
     * Converts a resource to json.
     *
     * @param $resource
     *
     */
    public static function toJson($resource)
    {
        return json_encode($resource);
    }
}
