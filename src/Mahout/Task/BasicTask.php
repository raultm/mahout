<?php

namespace Mahout\Task;

class BasicTask
{

    protected $actionPattern = "";
    protected $actionType = "";
    protected $action = "";
    protected $params = [];

    public static function params(){
        return new BasicTask();
    }
    
    public function __construct($params = []){
        if(is_array($params)){
            $this->params = $params;
        }
    }
    
    public function getRequest(){
        $action = $this->actionPattern;
        foreach($this->params as $key => $value){
            $action = str_replace("[$key]", $value, $action);
        }
        $request["action"] = $action;
        $request["type"] = $this->actionType;
        return $request;
    }
    
    public function handleResponse($reponse){
        return "basictask";
    }
    
}