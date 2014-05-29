<?php

namespace Mahout\Task;

use Mahout\Entity\Filter;

class FindFilterTask extends BasicTask
{

    protected $actionPattern = "/filter/[id]";
    protected $actionType = "get";

    public function handleResponse($response){
        return Filter::parseJsonString($response);
    }
}