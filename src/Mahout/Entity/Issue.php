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
	
	public function getId(){
		return $this->jiraObject->id;
	}
	
	public function getKey(){
		return $this->jiraObject->key;
	}
	
	public function getSummary(){
		return $this->jiraObject->fields->summary;
	}
}