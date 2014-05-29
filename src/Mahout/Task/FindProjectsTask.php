<?php

namespace Mahout\Task;

use Mahout\Entity\Project;

class FindProjectsTask extends BasicTask
{

    protected $actionPattern = "/project/";
    protected $actionType = "get";

    public function handleResponse($response){
        return Project::parseProjectsFromSearchJson($response);
    }
}