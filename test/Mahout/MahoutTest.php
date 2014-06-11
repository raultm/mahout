<?php

namespace Mahout;

class MahoutTest extends \PHPUnit_Framework_TestCase
{
    
    public $mahout;
    
    public function setup(){
	    $client = Http\ClientFactory::getInstance([], 'test');
        $this->mahout = Mahout::setClient($client);
    }
    
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
        $task = Task\Factory::get("Weird");
        $result = $this->mahout->perform($task);
    }
    
    public function testMahoutCanPerformBasicTask()
    {
        $task = Task\Factory::get("Basic");
        $result = $this->mahout->perform($task);
        $this->assertEquals("basictask", $result);
    }
    
    public function testMahoutCanUseFindLabelTaskWithIdParam()
    {
        $task = Task\Factory::get("FindFilter", ["id" => 10800]);
        $result = $this->mahout->perform($task);
        $this->assertEquals(
            Entity\Filter::parseJsonString(file_get_contents("./responses/filter10800.json")),
            $result 
        );
    }
    
    public function testMahoutCanUseFindIssueTaskWithIdParam()
    {
        $task = Task\Factory::get("FindIssue", ["id" => "14815"]);
        $result = $this->mahout->perform($task);
        $this->assertEquals(
            Entity\Issue::parseJsonString(file_get_contents("./responses/issue14815.json")),
            $result
        );
    }

    public function testMahoutCanUseFindIssueTaskWithIdParamAndRetrieveRenderedFields()
    {
        $task = Task\Factory::get("FindIssue", ["id" => "14815"]);
        $result = $this->mahout->perform($task);
        $this->assertEquals("21/Mar/2014 9:44 AM", $result->getResolutiondate());
    }



    public function testMahoutCanUseFindIssuesTaskWithJqlParam()
    {
        $task = Task\Factory::get("FindIssues", ["jql" => "labels = bolsa2014 ORDER BY createdDate DESC"]);
        $result = $this->mahout->perform($task);
        $this->assertEquals(1, count($result["issues"]));
        $this->assertEquals("14815", $result["issues"][0]->getId());
    }

    public function testMahoutCanUseFindProjectsTask()
    {
        $task = Task\Factory::get("FindProjects");
        $result = $this->mahout->perform($task);
        $this->assertEquals(1, count($result));
    }

    public function testMahoutCanUseFindProjectWithIdParamTask()
    {
        $task = Task\Factory::get("FindProject", ["id" => "10001"]);
        $result = $this->mahout->perform($task);
        $this->assertEquals("UB", $result->getKey());
    }
}
