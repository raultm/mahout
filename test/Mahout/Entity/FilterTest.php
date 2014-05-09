<?php

namespace Mahout\Entity;


class FilterTest extends \PHPUnit_Framework_TestCase
{
	public function getJsonLabel(){
		$data = [
			[file_get_contents('./responses/filter10800.json'), 10800, "PLAN2014", "labels = bolsa2014 ORDER BY createdDate DESC"],
		];
		return $data;
	}
	
	/**
	* @dataProvider getJsonLabel
	*/ 
    public function testCreateFilterObjectFromJsonString($jsonString)
    {
    	$filter = Filter::parseJsonString($jsonString);
    	$this->assertEquals($jsonString, $filter->toJsonString());
    }
    
    /**
	* @dataProvider getJsonLabel
	*/ 
    public function testFilterFieldsIdNameAndJql($jsonString, $filterId, $filterName, $filterJql)
    {
    	$filter = Filter::parseJsonString($jsonString);
    	$this->assertEquals($filterId, $filter->getId());
    	$this->assertEquals($filterName, $filter->getName());
    	$this->assertEquals($filterJql, $filter->getJql());
    }
    
    
 
}
