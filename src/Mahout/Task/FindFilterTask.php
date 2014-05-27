<?php

namespace Mahout\Task;

use Mahout\Entity\Filter;

class FindFilterTask extends BasicTask
{

    protected $actionPattern = "/filter/[id]";
    protected $actionType = "get";

    public static function params($params){
        return new FindFilter($params);
    }
    
    public function handleResponse($response){
        return Filter::parseJsonString($response);
    }
}