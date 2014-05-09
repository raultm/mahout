<?php

namespace Mahout\Http;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function getClientConfigurations(){
        return[
            [
                ["user" => "raul","pass" => "pass", "endpoint" => "https://kinetica.atlassian.net/rest/api/latest/"],
                "live"
            ],
            [
                ["user" => "raultm","pass" => "password", "endpoint" => "https://kinetica.atlassian.net/rest/api/latest/"],
                ""
            ],
            
        ];
    }
    
    public function testGenerateGuzzleAdapterClientIfNoTypeSelected()
    {
        $client = ClientFactory::getInstance([]);
        $this->assertEquals("Mahout\Http\GuzzleAdapterClient", get_class($client));
    }
    
    public function testGenerateMockClientIfTestType()
    {
        $client = ClientFactory::getInstance([], "test");
        $this->assertEquals("Mahout\Http\MockClient", get_class($client));
    }
    
    /**
    * @dataProvider getClientConfigurations
    */
    public function testCheckDifferentClientConfigurations($configuration, $clientType){
        $client = ClientFactory::getInstance($configuration, $clientType);
        $this->assertEquals(
            "Basic " . base64_encode($configuration["user"] . ":" . $configuration["pass"]),
            $client->getBasicAuthHeader()
        );
    }
    
}
