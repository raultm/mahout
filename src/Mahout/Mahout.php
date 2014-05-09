<?php

namespace Mahout;

class Mahout
{
	
	private static $instance;
	
	private $client = null;
	private $task = null;
	
	
	public static function setClient($client){
		if(!$client instanceof Http\Client){
			 throw new \InvalidArgumentException;
		}
		if(Mahout::$instance == null){
			Mahout::$instance = new Mahout;
		}
		Mahout::$instance->client = $client;
		return Mahout::$instance;
	}
	
	public function getClient(){
		return Mahout::$instance->client;
	}
	
	public function perform($task){
		$this->task = $task;
		$response = $this->client->handleRequest($this->task->getRequest());
		return $this->task->handleResponse($response);
	}
	
}