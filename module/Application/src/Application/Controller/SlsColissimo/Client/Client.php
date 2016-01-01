<?php

namespace Application\Controller\SlsColissimo\Client;

use Application\Controller\SlsColissimo\soap\doClient;
use Application\Controller\SlsColissimo\generateLabel;

class Client implements ClientInterface
{
	/**
	 * PHP SOAP client for interacting with the WSColiPosteLetterService API
	 *
	 * @var SoapClient
	 */
	protected $soapClient;
	/**
	 * Construct SO Flexibilite SOAP client
	 *
	 * @param \SoapClient $soapClient
	 */
/*
	public function __construct(\Zend\Soap\Client $soapClient)
	{
		$this->soapClient = $soapClient;
	}
*/
	public function __construct(doClient $soapClient)
	{
		$this->soapClient = $soapClient;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see 
	 * 	 
	 * */
	public function generateLabel(generateLabel $request)
	{	    	      
	    
	    $result = $this->soapClient->__soapCall('generateLabel', array($request)); 
	    
	    echo "<p>BEGIN client show result <p>";
	    var_dump($result);
	    
	    echo "<p>END client show result <p>";
	    
	    
        return $result;
	}
	

	
	public function getLastRequest()
	{
	    echo "REQUEST:<p>" . $this->soapClient->__getLastRequest() . "<p>";
	}
	
	public function getLastResponse()
	{
		return $this->soapClient->__getLastResponse();
	}
	
	
}