<?php

namespace Mahout\Task;

use Mahout\Entity\Issue;

class FindIssueTask extends BasicTask
{
    
    private $actionPattern = "/issue/[id]";
    private $action = "";
    
    private $params;
    
    public function __construct($params = []){
        $this->params = $params;
    }
    
    public function handleResponse($response){
        return Issue::parseJsonString($response);
    }
    
    public function getRequest(){
        $request = parent::getRequest();
        $request["type"] = "get";
        $action = $this->actionPattern;
        foreach($this->params as $key => $value){
            $action = str_replace("[$key]", $value, $action);
        }
        $request["action"] = $action;
        return $request;
    }
    
}