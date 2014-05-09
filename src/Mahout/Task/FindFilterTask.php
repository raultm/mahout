<?php

namespace Mahout\Task;

use Mahout\Entity\Filter;

class FindFilterTask extends BasicTask
{
    
    private $actionPattern = "/filter/[id]";
    private $action = "";
    
    public static function params($params){
        return new FindFilter($params);
    }
    
    private $params;
    
    public function __construct($params = []){
        $this->params = $params;
    }
    
    public function handleResponse($response){
        return Filter::parseJsonString($response);
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