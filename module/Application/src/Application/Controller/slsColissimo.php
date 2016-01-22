<?php
namespace Application\Controller;


use Application\Controller\SlsColissimo\Client\ClientBuilder;
use Application\Controller\SlsColissimo\generateLabelRequest;
use Application\Controller\SlsColissimo\outputFormat;
use Application\Controller\SlsColissimo\letter;
use Application\Controller\SlsColissimo\service;
use Application\Controller\SlsColissimo\parcel;
use Application\Controller\SlsColissimo\customsDeclarations;
use Application\Controller\SlsColissimo\contents;
use Application\Controller\SlsColissimo\article;
use Application\Controller\SlsColissimo\category;
use Application\Controller\SlsColissimo\sender;
use Application\Controller\SlsColissimo\address;
use Application\Controller\SlsColissimo\addressee;
use Application\Controller\SlsColissimo\generateLabel;
use Application\Controller\SlsColissimo\Pinyin\Pinyin;
use Zend\Filter\File\UpperCase;



class slsColissimo{
    
    private $senderName;
    private $senderAdresse;
    private $senderCity;
    private $senderZipCode;
    private $senderTelephone;   
    
    private $addresseeName;
    private $addresseeAddrese;
    private $addresseeCountryCode;
    
    private $addresseeCity;
    private $addresseeZipCode;
    private $addresseeMobileNumber;
    
    private $articleDescriptif;
    private $articleWeight;
    private $articleValue;
    
    private $amountTotal;
    private $insurance;
    
    private $PARCEL_LENGTH = 13;
    private $CONSTRANUM = '';
    private $MOTCLE = '';
    

    private $pdfUrl;
    private $parcelNum;
    private $id;
    
    private $articlesDecelaration;
    

    public function setArticleDecelaration($articles) {
    	$this->articlesDecelaration = $articles;
    }
    
    
	/**
	 * @return the $pdfUrl
	 */
	public function getPdfUrl() {
		return $this->pdfUrl;
	}

	/**
	 * @return the $parcelNum
	 */
	public function getParcelNum() {
		return $this->parcelNum;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param field_type $pdfUrl
	 */
	public function setPdfUrl($pdfUrl) {
		$this->pdfUrl = $pdfUrl;
	}

	/**
	 * @param field_type $parcelNum
	 */
	public function setParcelNum($parcelNum) {
		$this->parcelNum = $parcelNum;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @param field_type $senderName
	 */
	public function setSenderName($senderName) {
		$this->senderName = $senderName;
	}

	/**
	 * @param field_type $senderAdresse
	 */
	public function setSenderAdresse($senderAdresse) {
		$this->senderAdresse = $senderAdresse;
	}

	/**
	 * @param field_type $senderCity
	 */
	public function setSenderCity($senderCity) {
		$this->senderCity = $senderCity;
	}

	/**
	 * @param field_type $senderZipCode
	 */
	public function setSenderZipCode($senderZipCode) {
		$this->senderZipCode = $senderZipCode;
	}

	/**
	 * @param field_type $senderTelephone
	 */
	public function setSenderTelephone($senderTelephone) {
		$this->senderTelephone = $senderTelephone;
	}

	
		
	/**
	 * @param field_type $addresseeName
	 */
	public function setAddresseeName($addresseeName) {
		$this->addresseeName = $addresseeName;
	}

	/**
	 * @param field_type $addresseeAddrese
	 */
	public function setAddresseeAddrese($addresseeAddrese) {
		$this->addresseeAddrese = $addresseeAddrese;
	}

	/**
	 * @param field_type $addresseeCountryCode
	 */
	public function setAddresseeCountryCode($addresseeCountryCode) {
		$this->addresseeCountryCode = $addresseeCountryCode;
	}

	/**
	 * @param field_type $addresseeCity
	 */
	public function setAddresseeCity($addresseeCity) {
		$this->addresseeCity = $addresseeCity;
	}

	/**
	 * @param field_type $addresseeZipCode
	 */
	public function setAddresseeZipCode($addresseeZipCode) {
		$this->addresseeZipCode = $addresseeZipCode;
	}

	/**
	 * @param field_type $addresseeMobileNumber
	 */
	public function setAddresseeMobileNumber($addresseeMobileNumber) {
		$this->addresseeMobileNumber = $addresseeMobileNumber;
	}
	
	
	/**
	 * @param field_type $articleDescriptif
	 */
	public function setArticleDescriptif($articleDescriptif) {
		$this->articleDescriptif = $articleDescriptif;
	}

	/**
	 * @param field_type $articleWeight
	 */
	public function setArticleWeight($articleWeight) {
		$this->articleWeight = $articleWeight;
	}

	/**
	 * @param field_type $articleValue
	 */
	public function setArticleValue($articleValue) {
		$this->articleValue = $articleValue;
	}

	

	
	/**
	 * @return the $acountTotal
	 */
	public function getAmountTotal() {
		return $this->amountTotal;
	}

	/**
	 * @return the $insurance
	 */
	public function getInsurance() {
		return $this->insurance;
	}

	/**
	 * @param field_type $acountTotal
	 */
	public function setAmountTotal($acountTotal) {
		$this->amountTotal = $acountTotal;
	}

	/**
	 * @param field_type $insurance
	 */
	public function setInsurance($insurance) {
		$this->insurance = $insurance * 100;
	}

	private function getEnveloppe($response){	  
	   	   
	  $response = substr($response, 0, 1536);
	   
	  // get url
	  $tempstr = stristr($response, "https://ws.colissimo.fr");
	  if ($tempstr == ''){
	      var_dump($response);
	  }

	  
	  $majStr = strtoupper($tempstr); 
	  $signature = substr($tempstr, strpos($majStr, "SIGNATURE=") + strlen("SIGNATURE="), 64);
	  $this->parcelNum = substr($tempstr, strpos($majStr, "PARCELNUMBER=") + strlen("PARCELNUMBER="), 13);
	  
	  $this->pdfUrl = "https://ws.colissimo.fr/sls-ws/GetLabel?parcelNumber=" . $this->parcelNum . "&includeCustomsDeclarations=true&signature=" . $signature; 
	  
	  	  
	  // get id
	  $begin = strpos($response, '<id>');
	  if ($begin != false)
	  {
    	  $begin += 4;
    	  $end = strpos($response, '</id>');
    	  $this->id = substr($response, $begin, $end - $begin);
	  }
	  
	}
	
	
	
	private function parseMessage($enveloppe){
	    if ($enveloppe != ''){        
	        try{
	            
	            
	            echo '<pre>'. htmlentities($enveloppe) . '</pre>';
    	        $xx = new \DOMDocument('1.0', 'UTF-8');
    	        $xx->loadXML($enveloppe);
    	        $id =  $xx->getElementsByTagName('id')->item(0)->nodeValue;
    	        if (0 == $id)
    	        {
    	        	$this->setPdfUrl($xx->getElementsByTagName('pdfurl')->item(0)->nodeValue);
    	        	$this->setParcelNum($xx->getElementsByTagName('parcelnumber')->item(0)->nodeValue);
    	        }else{
    	        	$this->setMessage($xx->getElementsByTagName('messagecontent')->item(0)->nodeValue);
    	        }
	          	
	       } catch (\DOMException  $e) {
    		  echo ('Parse error with code ' . $e->code);
    		  $this->id = 501;
    	   }
	    }
	}
	
	private function parseAdresse($addresse, &$addresseRec){
//	    $addresse = "a1b2c3d4e3f4l6c8m0a1l2k3j4l5k6j7a1b2c3d4e3f4l6c8m0a1l2k3j4l5k6j7k6j7a1b2c3d4e3f4l6c8m0a1l2k3j4l5k6j7k6j7a1b2c3d4e3f4l6c8m0a1l";
	    
	    $adsPinYin = Pinyin::trans($addresse);
	    $adsLength = strlen($adsPinYin);
	    
	    $ads0 = "";
	    $ads01 = "";
	    $ads02 = "";
	    $ads03 = "";
	    
/* 	    
     if ($adsLength > 96)
	    {
	    	$ads0 = substr($adsPinYin, 0,32);
	    	$ads01 = substr($adsPinYin, 32, 32);
	    	$ads02 = substr($adsPinYin, 64, 32);
	    	$ads03 = substr($adsPinYin, 96, 32);
	    }else if ($adsLength > 64 && $adsLength <= 96){
	        $ads0 = substr($adsPinYin, 0, 32);
	    	$ads01 = substr($adsPinYin, 32, 32);
	    	$ads02 = substr($adsPinYin, 64, 32);
	    }else if ($adsLength > 32 && $adsLength <= 64){
	    	$ads01 = substr($adsPinYin, 0,32);
	    	$ads02 = substr($adsPinYin, 32, 32);
	    }else if ($adsLength <= 32){
	    	$ads02 = $adsPinYin;
	    } 
	    
*/
	    
	    
	    if ($adsLength > 64){

	    	$ads01 = substr($adsPinYin, 0, 32);
	    	$ads02 = substr($adsPinYin, 32, 32);
	    	$ads03 = substr($adsPinYin, 64, 32);
	    }else if ($adsLength > 32 && $adsLength <= 64){
	        $ads01 = substr($adsPinYin, 0,32);
	    	$ads02 = substr($adsPinYin, 32, 32);
	    }else if ($adsLength <= 32){
	    	$ads02 = $adsPinYin;
	    }
	    
	    
	    
	    
	    
	    
		    
	    $addresseRec->setLine0($ads0);
	    $addresseRec->setLine1($ads01);
	    $addresseRec->setLine2($ads02);
	    $addresseRec->setLine3($ads03);
	    
	}
	
	public function test(){
        // declare letter
        $letter = new letter();
        
        // declare outputFormat
        $outputFormat = new outputFormat();
        $outputFormat->setX(0);
        $outputFormat->setY(0);
        $outputFormat->setOutputPrintingType('PDF_A4_300dpi');
        //$outputFormat->setReturnType('SendPDFByMail');
       
        
        // declare service
        $service = new service();
        //date('Y-m-d')
        $service->setDepositDate(date('Y-m-d'));
        $service->setProductCode("COLI");
        
        $service->setTotalAmount($this->amountTotal);
        $service->setReturnTypeChoice('3');
        // set service
        $letter->setService($service);
        
        
        // declare parcel
        $parcel = new parcel();
        $parcel->setWeight($this->articleWeight);
        
        
//        $parcel->setCOD(0);
//        $parcel->setCODAmount(0);
//        $parcel->setInstructions('');
        $parcel->setInsuranceValue($this->insurance);
        
        $parcel->setNonMachinable(1);
//        $parcel->setRecommendationLevel('R1');
        $parcel->setReturnReceipt(1);
        $parcel->setFtd(0);

        // set parcel
        $letter->setParcel($parcel);
        
        // declare customsDeclarations
        $customsDeclarations = new customsDeclarations();
        
        $contents = new contents();                
        
        // 添加包裹物品清单
        $articleCount = count($this->articlesDecelaration);
        
        
/*         
        var_dump($this->articlesDecelaration);
        echo "<br>";
        var_dump($articleCount);
        echo "<br>change";
        die(); 
*/
              
        for ($index = 0; $index < 10 && $index < $articleCount; $index++)
        {
            $article = new article();
            $article->setDescription($this->articlesDecelaration[$index]['description']);
            $article->setQuantity($this->articlesDecelaration[$index]['quantity']);
            $article->setWeight($this->articlesDecelaration[$index]['poids']);
            $article->setValue($this->articlesDecelaration[$index]['valeur']);
            $article->setOriginCountry('FR');        	
                 
            $contents->setArticle($article);
       
        }
      
        
        /*
        $article = new article();
        $article->setDescription("GeRenWuPin");
        $article->setQuantity(1);
        $article->setWeight($this->articleWeight);
        $article->setValue($this->articleValue);
        $article->setOriginCountry('FR');
        
        $contents->setArticle($article);
        
        */
        

        
        if ($articleCount == 0) {
            $article = new article();
            $article->setDescription($this->articleDescriptif);
            $article->setQuantity(1);
            $article->setWeight($this->articleWeight);
            $article->setValue($this->articleValue);
            $article->setOriginCountry('FR');
                        
            $contents->setArticle($article);
        }
        
        
        $category = new category();
        $category->setValue(1);
        $contents->setCategory($category);
        
        $customsDeclarations->setContents($contents);
        $customsDeclarations->setIncludeCustomsDeclarations(1);
        
        
        
        // declare sender
        $sender = new sender();
        $address = new address();
        $address->setLastName(Pinyin::trans($this->senderName));

        $this->parseAdresse($this->senderAdresse, $address);
//        $address->setLine2(Pinyin::trans($this->senderAdresse));
       // $address->setLine3("");

        $address->setCountryCode("FR");
        $address->setCity(Pinyin::trans($this->senderCity));
        $address->setZipCode($this->senderZipCode);
        $address->setMobileNumber($this->senderTelephone);
        $address->setPhoneNumber($this->senderTelephone);
        
               
        
        
        $sender->setAddress($address);
        
        // set sender
        $letter->setSender($sender);
        
        // declare addressee
        $addressee = new addressee();
        
        $addressRec = new address();
        $addressRec->setLastName(Pinyin::trans($this->addresseeName));
        
        $this->parseAdresse($this->addresseeAddrese, $addressRec);
        
        $addressRec->setCountryCode($this->addresseeCountryCode);
        $addressRec->setCity(Pinyin::trans($this->addresseeCity));
        $addressRec->setZipCode($this->addresseeZipCode);
        $addressRec->setMobileNumber($this->addresseeMobileNumber);
        $addressRec->setPhoneNumber($this->addresseeMobileNumber);        
         
        $addressee->setAddress($addressRec);
        
        $letter->setCustomsDeclarations($customsDeclarations);
        $letter->setAddressee($addressee);
        
        $generateLabelRequest = new generateLabelRequest();
        
        $generateLabelRequest->setContractNumber($this->CONSTRANUM);
        $generateLabelRequest->setPassword($this->MOTCLE);
        $generateLabelRequest->setOutputFormat($outputFormat);
        $generateLabelRequest->setLetter($letter);
        
        $generateLabel = new generateLabel();
        $generateLabel->setGenerateLabelRequest($generateLabelRequest);
        
        try{
            // create the webservice client
            $clientBuilder = new ClientBuilder();
            $client = $clientBuilder->build();
            $response = $client->generateLabel($generateLabel);
             
                    
         } catch (\SoapFault $f) {
//        	echo "check it soap error : " . $f->getMessage(). "<p>";
         }
         
         $enveloppe = $this->getEnveloppe($client->getLastResponse());
         
        // $this->parseMessage($enveloppe);
 
    }
    
    
}
