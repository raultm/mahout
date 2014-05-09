<?php

namespace Mahout\Http;

class ClientFactory{
    
    public static function getInstance($configuration, $type = 'live'){
        if($type == "test"){
            return new MockClient($configuration);
        }
        return new GuzzleAdapterClient($configuration);
    }
    
}