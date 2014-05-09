<?php

namespace Mahout\Entity;

class Filter
{
	public static function parseJsonString($json){
		$label = new Filter($json);
		return $label;
	}
	
	private $json;
	private $jiraObject;
	
	private function __construct($jsonFilter){
		$this->json = $jsonFilter;
		$this->jiraObject = json_decode($jsonFilter);
	}
	
	public function toJsonString(){
		return $this->json;
	}
	
	public function getId(){
		return $this->jiraObject->id;
	}
	
	public function getName(){
		return $this->jiraObject->name;
	}
	
	public function getJql(){
		return $this->jiraObject->jql;
	}
}