<?php

namespace Mahout\Task;

use Mahout\Entity\Project;

class FindProjectTask extends BasicTask
{
    
    protected $actionPattern = "/project/[id]";
    protected $actionType = "get";

    public function handleResponse($response){
        return Project::parseJsonString($response);
    }
}