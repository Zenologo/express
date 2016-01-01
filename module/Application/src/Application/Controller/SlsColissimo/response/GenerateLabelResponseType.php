<?php
namespace Application\Controller\SlsColissimo\response;

use Application\Controller\SlsColissimo\response\baseResponse;
use Application\Controller\SlsColissimo\response\Message;
use Application\Controller\SlsColissimo\response\labelResponse;


class GenerateLabelResponseType extends baseResponse {
	
    public function __construct(Message $message){
    	$this->setMessages($message);
    }
    
//    protected $labelXmlReponse;
    
    
    protected $labelResponse;
    
	/**
	 * @return the $labelXmlReponse
	 */
/* 	public function getLabelXmlReponse() {
		return $this->labelXmlReponse;
	} */

	/**
	 * @return the $labelResponse
	 */
	public function getLabelResponse() {
		return $this->labelResponse;
	}

	/**
	 * @param field_type $labelXmlReponse
	 */
/* 	public function setLabelXmlReponse( $labelXmlReponse) {
		$this->labelXmlReponse = $labelXmlReponse;
	} */

	/**
	 * @param field_type $labelResponse
	 */
	public function setLabelResponse(labelResponse $labelResponse) {
		$this->labelResponse = $labelResponse;
	}

    
    
    
	/**
	 * Getter
	 *
	 * @param string $name
	 */
	public function __get($name)
	{
		$method = 'get' . ucfirst($name);
		if (method_exists($this, $method)) {
			return $this->$method();
		}
		return false;
	}
	
	
	/**
	 * Setter
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function __set($name, $value)
	{
		$method = 'set' . ucfirst($name);
		if (method_exists($this, $method)) {
			return $this->$method($value);
		}
	}
    
    
    
}