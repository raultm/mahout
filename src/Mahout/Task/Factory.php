<?php

namespace Mahout\Task;

class Factory
{

    public static function get($taskName, $params = null){
        $taskObjectName = "Mahout\\Task\\" . $taskName . "Task";
        if(!class_exists($taskObjectName)){
            throw new \InvalidArgumentException("$taskObjectName doesn't exist");
        }
        return new $taskObjectName($params);
    }
}