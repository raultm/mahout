<?php

namespace Mahout\Http;

use GuzzleHttp;

class GuzzleAdapterClient extends BaseClient{
    
    public function handleRequest($request){
        $actionType = $request["type"];
        $actionUrl = $this->getEndpoint() . $request["action"];
        $response =  \GuzzleHttp\get($actionUrl, [
            'headers' => ['Authorization' => $this->getBasicAuthHeader()],
        ]);
        return json_encode($response->json());
        
    }
    
}