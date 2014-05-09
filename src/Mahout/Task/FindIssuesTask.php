<?php

namespace Mahout\Task;

use Mahout\Entity\Issue;

class FindIssuesTask extends BasicTask
{
	
	private $actionPattern = "/search/?jql=[jql]";
	private $action = "";
	
	private $params;
	
	public function __construct($params = []){
		$this->params = $params;
	}
	
	public function handleResponse($response){
		return Issue::parseIssuesFromSearchJson($response);
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