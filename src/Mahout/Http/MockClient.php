<?php

namespace Mahout\Http;

class MockClient extends BaseClient{
    
    
    public function request($type, $options){
        
    }
    
    private function get($options){
        
    }
    
    public function handleRequest($request){
        if(!isset($request["type"])){ return parent::handleRequest($request); }
        if($request["type"] == "get"){
            $requestActionArray = explode("/", $request["action"]);
            $emptyBeginning = $requestActionArray[0];
            $action = $requestActionArray[1];
            $param = "";
            if(isset($requestActionArray[2])){
                $param = $requestActionArray[2];
            }
            if($action == "filter"){
                $filterId = $param;
                return file_get_contents("./responses/filter$filterId.json");
            }
            if($action == "issue"){
                $issueId = str_replace("?expand=renderedFields", "", $param);
                return file_get_contents("./responses/issue$issueId.json");
            }
            if($action == "search"){
                $issueId = $param;
                return file_get_contents("./responses/searchByFilter10800.json");
            }
            if($action == "project"){
                return file_get_contents("./responses/projects.json");
            }
        }
    }
}