<?php

namespace Mahout\Task;

use Mahout\Entity\Issue;

class FindIssueTask extends BasicTask
{
    
    protected $actionPattern = "/issue/[id]";
    protected $actionType = "get";

    public function handleResponse($response){
        return Issue::parseJsonString($response);
    }
}