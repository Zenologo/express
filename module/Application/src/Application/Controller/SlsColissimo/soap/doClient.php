<?php


namespace Application\Controller\SlsColissimo\soap;


use \SoapClient;
use \DomDocument;
//use Zend\XmlRpc\Generator\DomDocument;




class doClient extends SoapClient
{
    
    
    function delNamespace($xml){
        $xml = str_replace( '<ns1:generateLabel>', '<sls:generateLabel>', $xml );
        $xml = str_replace( '</ns1:generateLabel>', '</sls:generateLabel>', $xml );
        
        $xml = str_replace( 'ns1:outputFormat', 'outputFormat', $xml );
        $xml = str_replace( '/ns1:outputFormat', '/outputFormat', $xml );
        $xml = str_replace( 'xsi:type="outputFormat"', '', $xml );
        
        
        $xml = str_replace( 'ns1:letter', 'letter', $xml );
        $xml = str_replace( '/ns1:letter', '/letter', $xml );
        $xml = str_replace( 'xsi:type="letter"', '', $xml );
        
        $xml = str_replace( 'ns1:address', 'address', $xml );
        $xml = str_replace( '/ns1:address', '/address', $xml );
        $xml = str_replace( 'xsi:type="address"', '', $xml );
        
        
        
        
        
        
        $xml = str_replace( '<ns1:', '<', $xml );
        $xml = str_replace( '</ns1:', '</', $xml );
        //$xml = str_replace( 'xmlns:ns1', 'xmlns:sls', $xml );
        return $xml;
    }
    

    
    function test(){
    	

        $tt = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> <ns1:test>this a test </ns1:test>";
        $tt = mb_convert_encoding($tt, 'UTF-8');
        
        var_dump($tt);
        
        echo "<p>";
    }
    
    function checkRequest($request){
    	$tt = new \Zend\XmlRpc\Generator\DomDocument;
        echo $tt->getEncoding($request) . "<p>";
        
//        var_dump($tt->saveXml($request));
        
        
        
    }
    
    
    
    
    
    function __doRequest( $request, $location, $action, $version = SOAP_1_1, $one_way = 0 ) {
        
        global $namespace;        
        
//        $this->checkRequest($request);
        

        
//        $request = $this->delNamespace($request);        
        
        //$dom = new DomDocument('1.0', "UTF-8"); 
        
    	try{
    		// load request xml
    //	    $dom->loadXML($request);
    //	    $test  = $dom->getElementsByTagName('sls:generateLabel');
  //          var_dump($dom->saveXML());
    	    
            
    //        $zfDom = new \Zend\XmlRpc\Generator\DomDocument($request);
     //       \Zend\Debug\Debug::dump($zfDom->saveXml());
    	      	
    	} catch (\DOMException  $e) {
    		die('Parse error with code ' . $e->code);
    	}
    	
    	
    	

   	
    	
    	$xml = explode('\r\n', parent::__doRequest($request, $location, $action, $version));
    	$response = preg_replace( '/^(\x00\x00\xFE\xFF|\xFF\xFE\x00\x00|\xFE\xFF|\xFF\xFE|\xEF\xBB\xBF)/', '', $xml[0] );

    	     	
/*     	echo "<p>var_dump1: <p>";
    	 
    	$firstIndex = stripos($xml[0], 'https');
    	$lastIndex = stripos($xml[0], 'includeCustomsDeclarations=true');
    	 
    	$pdfUrl =  substr($xml[0], $firstIndex, $lastIndex - $firstIndex + strlen('includeCustomsDeclarations=true'));
    	 
    	echo $pdfUrl . "<p>"; */

//    	echo "<p>test response : <p>";
//    	echo $response . "<p>";
    	
    	return $response;
    	
    	
       // die();
        
        return parent::__doRequest( $request, $location, $action, $version, $one_way = 0 );
    }
    
    function __construct($wsdl, $options) {
    	parent::__construct($wsdl, $options);
    }
}