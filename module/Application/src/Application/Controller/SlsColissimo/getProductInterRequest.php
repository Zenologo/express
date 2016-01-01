<?php
namespace Application\Controller\SlsColissimo;


class getProductInterRequest {
        
    
    protected $contractNumber;
    
    
    protected $password;
    
    
    protected $productCode;
    
    
    
    public function __construct($contrat, $pwd, $pCode){
    	$this->contractNumber = $contrat;
    	$this->password = $pwd;
    	$this->productCode = $pCode;
    }
    
    
    
    
    
    
    /**
	 * @return the $contractNumber
	 */
	public function getContractNumber() {
		return $this->contractNumber;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @return the $productCode
	 */
	public function getProductCode() {
		return $this->productCode;
	}

	/**
	 * @param field_type $contractNumber
	 */
	public function setContractNumber($contractNumber) {
		$this->contractNumber = $contractNumber;
	}

	/**
	 * @param field_type $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @param field_type $productCode
	 */
	public function setProductCode($productCode) {
		$this->productCode = $productCode;
	}

	/* 
    protected $insurance;
    
    protected $nonMachinable;
    
    
    protected $returnReceipt;
    
    protected $countryCode;
    protected $zipCode;
    protected $city;
    
     */
    
    
    
    
    
    
    
    
    
    
    

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