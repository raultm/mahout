<?php

namespace Mahout;

class MahoutTest extends \PHPUnit_Framework_TestCase
{
	
	/**
	* @expectedException InvalidArgumentException
	*/
    public function testThrowExceptionIfClientDoesntImplementsClientInterface()
    {
    	Mahout::setClient("string");
    }
 
	public function testClientParamIsUsedByMahout()
    {
    	$client = Http\ClientFactory::getInstance([], 'test');
    	Mahout::setClient($client);
    	$this->assertEquals($client, Mahout::setClient($client)->getClient());
    }
    
    /**
	* @expectedException InvalidArgumentException
	*/
    public function testMahoutThrowInvalidArgumentExceptionIfTaskDoesntExist()
    {
    	$client = Http\ClientFactory::getInstance([], 'test');
    	$mahout = Mahout::setClient($client);
    	$task = Task\Factory::get("Weird");
    	$result = $mahout->perform($task);	
    }
    
    public function testMahoutCanPerformBasicTask()
    {
    	$client = Http\ClientFactory::getInstance([], 'test');
    	$mahout = Mahout::setClient($client);
    	$task = Task\Factory::get("Basic");
    	$result = $mahout->perform($task);	
    	$this->assertEquals("basictask", $result);
    }
    
    public function testMahoutCanUseFindLabelTaskWithIdParam()
    {
    	$client = Http\ClientFactory::getInstance([], 'test');
    	$mahout = Mahout::setClient($client);
    	$task = Task\Factory::get("FindFilter", ["id" => 10800]);
    	$result = $mahout->perform($task);
    	$this->assertEquals(
    		Entity\Filter::parseJsonString(file_get_contents("./responses/filter10800.json")),
    		$result	
    	);
    }
    
    public function testMahoutCanUseFindIssueTaskWithIdParam()
    {
    	$client = Http\ClientFactory::getInstance([], 'test');
    	$mahout = Mahout::setClient($client);
    	$task = Task\Factory::get("FindIssue", ["id" => "14815"]);
    	$result = $mahout->perform($task);
    	$this->assertEquals(
    		Entity\Issue::parseJsonString(file_get_contents("./responses/issue14815.json")),
    		$result
    	);
    }
    
    public function testMahoutCanUseFindIssuesTaskWithJqlParam()
    {
    	$client = Http\ClientFactory::getInstance([], 'test');
    	$mahout = Mahout::setClient($client);
    	$task = Task\Factory::get("FindIssues", ["jql" => "labels = bolsa2014 ORDER BY createdDate DESC"]);
    	$result = $mahout->perform($task);
    	$this->assertEquals(1, count($result["issues"]));
    	$this->assertEquals("14815", $result["issues"][0]->getId());
    }
    

}
