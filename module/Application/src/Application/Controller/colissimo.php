<?php

namespace Application\Controller;


use Zend\Soap\Client;
use Application\Controller\colissimo\DestEnv;
use Application\Controller\colissimo\ExpEnv;
use Application\Controller\colissimo\Address;
use Application\Controller\colissimo\AddressDest;
use Application\Controller\colissimo\Parcel;
use Application\Controller\colissimo\ServiceCallContext;
use Application\Controller\colissimo\LetterColissimoRequest;
use Application\Controller\colissimo\Util\ServiceAvailability;
use Application\Controller\colissimo\letter;
use Application\Controller\colissimo\Client\ClientBuilder;


//require_once __DIR__.'/colissimo/parameters.php';


class colissimo {

    private $parameters = array('account'=>'', 'password'=>'');
        
    protected $classmap = array(
    		'ServiceCallContextV2'       => '\Application\Controller\colissimo\ServiceCallContext',
    		'ArticleVO'                  => '\Application\Controller\colissimo\Article',
    		'ContentsVO'                 => '\Application\Controller\colissimo\Content',
    		'ParcelVO'                   => '\Application\Controller\colissimo\Parcel',
    		'AddressVO'                  => '\Application\Controller\colissimo\Address',
    		'DestEnvVO'                  => '\Application\Controller\colissimo\DestEnv',
    		'ExpEnvVO'                   => '\Application\Controller\colissimo\ExpEnv',
    		'LetterVO'                   => '\Application\Controller\colissimo\letter',
    		'Letter'                     => '\Application\Controller\colissimo\letter',
    		'getLetterColissimo'         => '\Application\Controller\colissimo\LetterColissimoRequest',
    		'ReturnLetterVO'             => '\Application\Controller\colissimo\ReturnLetter',
    		'getLetterColissimoResponse' => '\Application\Controller\colissimo\LetterColissimoResponse',
    );
    
    
    public function testColissimo()
    {
        $expAddress = new Address();
        $expAddress->setCompanyName('SI TONG EXPRESS');
        $expAddress->setLine2('3 RUE DU PONCEAU');
        $expAddress->setPostalCode('75002');
        $expAddress->setCity('Paris');
        // build the recipient address
        $destAddress = new AddressDest();
        $destAddress->setCivility('M');
        $destAddress->setName('Prenom');
        $destAddress->setSurname('Nom');
        $destAddress->setLine2('Place de la Comedie');
        $destAddress->setPostalCode('455000');
        $destAddress->setCity('HENAN');
        $destAddress->setPhone('0606060606');
        $destAddress->setEmail('email@client.fr');
        
        // build the main letter object
        $letter = new letter();
        
        $letter->setContractNumber("821998");
        $letter->setPassword("ST0658134410");
        
        $letter->setService(new ServiceCallContext('Acme and Co'));
        $letter->setParcel(new Parcel(0.720));
        $letter->setExp(new ExpEnv($expAddress));
        $letter->setDest(new DestEnv($destAddress));
        // test service availability // optionnal
        $checker = new ServiceAvailability();
        $checker->check();
        // test letter object validity // optionnal
//        $validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')->getValidator();
 //       $violations = $validator->validate($letter);
//        if (count($violations) === 0) {

        
        
        if (true){
            
/*             $url = "http://ws.colissimo.fr/soap.shippingclpV2/services/WSColiPosteLetterService?wsdl";
            
            
            
            $cl = new Client($url, array("soap_version"=>constant('SOAP_1_2')));



            $ss = array("letter"=>array(
            	"contractNumber" => 821998,
                "password"=>"ST0658134410"
            ));
            
            $result = $cl->getLetterColissimo($ss);
            
            die();
            
            
     */
            
            
            
            
        	// create the webservice client
        	$clientBuilder = new ClientBuilder();
        	$client = $clientBuilder->build();   

        	
        	
        	
        	try {        	    
        	    
        		// call the webservice with the letter object
        	    
        	    $request = new LetterColissimoRequest($letter);
        		$response = $client->getLetterColissimo($request);
        		
        		var_dump($response);
        		die();

        		
        		var_dump($response);
        		if ($response->isSuccess()) {
        			$infos = $response->getReturnLetter();
        			// do what you want with the return infos
        			// $number = $infos->parcelNumber;
        			// $pdf    = $infos->PdfUrl;
        			var_dump($infos);
        		} else {
        			var_dump($response->getErrorMessage());
        		}
        	} catch (\SoapFault $f) {
        		// log the error
        		echo "check it soap error : " . $f->getMessage() . "<p>";
        	}
        }
    }
    
    
    public function checkCountry()
    {
       
        $option = array('location' => 'http://schemas.xmlsoap.org/wsdl/soap',
                    'uri' => 'http://schemas.xmlsoap.org/wsdl/soap/');
        
        $clientNotNet = New Client('http://ws.colissimo.fr/sls-ws/SlsServiceWS?wsdl', $option);
        
        $result = $clientNotNet->getFunctions();
        print_r($result);
        
        
        die();
        
        
        
        
        $client = new Client("http://www.webservicex.net/country.asmx?WSDL");
        
        $p = new \stdClass();
        $p->CountryName = 'France';
        
        
        $pp = array('CountryName' => 'Australia');
         
        $result = $client->GetCurrencyByCountry($pp);
        print_r($result);
    }
    
    
}