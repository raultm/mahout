<?php

namespace Mahout\Entity;

class IssueTest extends \PHPUnit_Framework_TestCase
{
    public function getJsonIssues(){
        $data = [
            [file_get_contents('./responses/issue14815.json'), "14815", "PLAN-572", "Cálculo correcto del VAN"],
        ];
        return $data;
    }
    
    /**
    * @dataProvider getJsonIssues
    */ 
    public function testCreateIssueObjectFromJsonString($jsonString)
    {
        $label = Issue::parseJsonString($jsonString);
        $this->assertEquals($jsonString, $label->toJsonString());
    }
    
    /**
    * @dataProvider getJsonIssues
    */ 
    public function testIssueFieldsId($jsonString, $issueId, $issueKey, $issueSummary)
    {
        $label = Issue::parseJsonString($jsonString);
        $this->assertEquals($issueId, $label->getId());
        $this->assertEquals($issueKey, $label->getKey());
        $this->assertEquals($issueKey, $label->getKey());
        $this->assertEquals($issueSummary, $label->getSummary());
    }
}
