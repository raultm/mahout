<?php

namespace Mahout\Entity;

class Project
{
    public static function parseJsonString($json){
        $project = new Project($json);
        return $project;
    }
    
    public static function parseProjectsFromSearchJson($jsonString){
        $searchJson = json_decode($jsonString);
        $result = [];
        foreach($searchJson as $project){
            $result[] = Project::parseJsonString(json_encode($project));
        }
        return $result;
    }
    
    private $json;
    private $jiraObject;
    
    private function __construct($jsonString){
        $this->json = $jsonString;
        $this->jiraObject = json_decode($jsonString);
    }
    
    public function toJsonString(){
        return $this->json;
    }

    public function __call($methodName, $arguments)
    {
        $methodWords = preg_split('/([[:upper:]][[:lower:]]+)/', $methodName, null, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
        if($methodWords[0] == 'get'){
            $fieldName = strtolower($methodWords[1]);
            if(isset($this->jiraObject->$fieldName)){
                return $this->jiraObject->$fieldName;
            }

            if(isset($this->jiraObject->fields->$fieldName)){
                return $this->jiraObject->fields->$fieldName;
            }

            echo "No existe el campo $fieldName";
            return false;
        }
    }
}