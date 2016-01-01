<?php
namespace Application\Controller\SlsColissimo;

use Application\Controller\SlsColissimo\getProductInterRequest;



class getProductInter{
	
    
    protected $getProductInterRequest;
    
    
    public function __construct(getProductInterRequest $getProductInterRequest){
    	$this->getProductInterRequest = $getProductInterRequest;
    }
	/**
	 * @return the $getProductInterRequest
	 */
	public function getGetProductInterRequest() {
		return $this->getProductInterRequest;
	}

	/**
	 * @param getProductInterRequest $getProductInterRequest
	 */
	public function setGetProductInterRequest($getProductInterRequest) {
		$this->getProductInterRequest = $getProductInterRequest;
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
	}
	
    
    
    
    
    
}