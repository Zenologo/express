<?php
namespace Application\Controller\SlsColissimo;


class addressee{
    
    
    /**
     * 
     * @var string
     */
    protected $addresseeParcelRef;
    

    
    /**
     * 
     * @var string
     */
    protected $serviceInfo;
    
    
    /**
     * 
     * @var address
     */
    protected $address;
    
	
    /**
	 * @return the $addresseeParcelRef
	 */
	public function getAddresseeParcelRef() {
		return $this->addresseeParcelRef;
	}


	/**
	 * @return the $serviceInfo
	 */
	public function getServiceInfo() {
		return $this->serviceInfo;
	}


	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param string $addresseeParcelRef
	 */
	public function setAddresseeParcelRef($addresseeParcelRef) {
		$this->addresseeParcelRef = $addresseeParcelRef;
	}


	/**
	 * @param string $serviceInfo
	 */
	public function setServiceInfo($serviceInfo) {
		$this->serviceInfo = $serviceInfo;
	}


	/**
	 * @param \Application\Controller\SlsColissimo\address $address
	 */
	public function setAddress(address $address) {
		$this->address = $address;
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