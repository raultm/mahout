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
			list($emptyBeginning, $action, $param) = explode("/", $request["action"]);
			if($action == "filter"){
				$filterId = $param;
				return file_get_contents("./responses/filter$filterId.json");
			}
			if($action == "issue"){
				$issueId = $param;
				return file_get_contents("./responses/issue$issueId.json");
			}
			if($action == "search"){
				$issueId = $param;
				return file_get_contents("./responses/searchByFilter10800.json");
			}
		}
	}
}