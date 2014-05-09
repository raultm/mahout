<?php

namespace Mahout\Task;

class BasicTask
{
    
    public static function params(){
        return new BasicTask();
    }
    
    private $params;
    
    public function __construct($params = []){
        $this->params = $params;
    }
    
    public function getRequest(){
        return [];
    }
    
    public function handleResponse($reponse){
        return "basictask";
    }
    
}