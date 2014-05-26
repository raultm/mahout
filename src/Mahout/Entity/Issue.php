<?php

namespace Mahout\Entity;

class Issue
{
    public static function parseJsonString($json){
        $label = new Issue($json);
        return $label;
    }
    
    public static function parseIssuesFromSearchJson($jsonString){
        $searchJson = json_decode($jsonString);
        $result = ["issues" => []];
        foreach($searchJson->issues as $issue){
            $result["issues"][] = Issue::parseJsonString(json_encode($issue));
        }
        return $result;
    }
    
    private $json;
    private $jiraObject;
    
    private function __construct($jsonLabel){
        $this->json = $jsonLabel;
        $this->jiraObject = json_decode($jsonLabel);
    }
    
    public function toJsonString(){
        return $this->json;
    }

    public function __call($methodName, $arguments)
    {
        $methodWords = preg_split('/([[:upper:]][[:lower:]]+)/', $methodName, null, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
        foreach($methodWords as $word){
            echo $word . "\n";
        }
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