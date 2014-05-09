<?php

namespace Mahout\Http;

class BaseClient implements Client{
    
    
    private $user;
    private $pass;
    
    private $endpoint;
    
    public function __construct($configuration){
        if(isset($configuration["user"])){
            $this->setUser($configuration["user"]);
        }
        
        if(isset($configuration["pass"])){
            $this->setPass($configuration["pass"]);
        }
        
        if(isset($configuration["endpoint"])){
            $this->setEndpoint($configuration["endpoint"]);
        }
    }
    
    public function getBasicAuthHeader(){
        return "Basic " . base64_encode($this->user . ":" . $this->pass);
    }
    
    public function getEndpoint(){
        return $this->endpoint;
    }
    
    private function  setUser($user){
        $this->user = $user;
    }
    
    private function  setPass($pass){
        $this->pass = $pass;
    }
    
    private function  setEndpoint($endpoint){
        $this->endpoint = $endpoint;
    }
    
    public function request($type, $options){
        return "basictask";
    }
    
    public function handleRequest($request){
        return "basictask";
    }

}