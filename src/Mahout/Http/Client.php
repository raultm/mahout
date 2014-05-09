<?php

namespace Mahout\Http;

interface Client{
	
	public function request($type, $options);
	public function getBasicAuthHeader();
	public function handleRequest($request);

}