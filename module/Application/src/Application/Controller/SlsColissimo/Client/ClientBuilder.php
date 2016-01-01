<?php

namespace Application\Controller\SlsColissimo\Client;

use Application\Controller\SlsColissimo\soap\SoapClientFactory;

/**
 * ClientBuilder for the WSColiPosteLetterService
 */
class ClientBuilder
{
	/**
	 * Construct client builder with required parameters
	 *
	 * @param string $wsdl Path to the WSColiPosteLetterService WSDL
	 */
    
	public function __construct($wsdl = 'http://ws.colissimo.fr/sls-ws/SlsServiceWS?wsdl')
	{

		$this->wsdl = $wsdl;
	}
	
	
	/**
	 * Build the WSColiPosteLetterService SOAP client
	 *
	 * @return Client
	 */
	public function build()
	{
	    
		$soapClientFactory = new SoapClientFactory();
		$soapClient = $soapClientFactory->create($this->wsdl);
		
		return new Client($soapClient);
	}
}