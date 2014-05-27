<?php

namespace Mahout\Task;

use Mahout\Entity\Issue;

class FindIssuesTask extends BasicTask
{

    protected $actionPattern = "/search/?jql=[jql]";
    protected $actionType = "get";

    public function handleResponse($response){
        return Issue::parseIssuesFromSearchJson($response);
    }
}