<?php
namespace Application\Controller\SlsColissimo;

class service 
{
    
    /**
     * 
     * @var string 
     * 'COLI'
     */
    protected $productCode;
    
    /**
     * 
     * @var date
     */
    protected $depositDate;
    
    
    /**
     * 
     * @var integer
     * ?
     */
    protected $transportationAmount;
    
    
    
    /**
     * 
     * @var integer
     * ?
     */
    protected $totalAmount;
    
    
    /**
     * 
     * @var $returnTypeChoice
     * '2'
     */
    protected $returnTypeChoice;
    
    
 
    

    
    
	/**
	 * @return the $productCode
	 */
	public function getProductCode() {
		return $this->productCode;
	}

	/**
	 * @return the $depositDate
	*/ 
	public function getDepositDate() {
		return $this->depositDate;
	}
    

	
	/**
	 * @return the $transportationAmount
	 */
	public function getTransportationAmount() {
		return $this->transportationAmount;
	}

	/**
	 * @return the $totalAmount
	 */
	public function getTotalAmount() {
		return $this->totalAmount;
	}



	/**
	 * @param string $productCode
	 */
	public function setProductCode($productCode) {
		$this->productCode = $productCode;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\date $depositDate
	 */
	public function setDepositDate($depositDate) {
		$this->depositDate = $depositDate;
	}

	/**
	 * @param number $transportationAmount
	 */
	public function setTransportationAmount($transportationAmount) {
		$this->transportationAmount = $transportationAmount;
	}

	/**
	 * @param number $totalAmount
	 */
	public function setTotalAmount($totalAmount) {
		$this->totalAmount = $totalAmount;
	}


	/**
	 * @return the $returnTypeChoice
	 */
	public function getReturnTypeChoice() {
		return $this->returnTypeChoice;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\$returnTypeChoice $returnTypeChoice
	 */
	public function setReturnTypeChoice($returnTypeChoice) {
		$this->returnTypeChoice = $returnTypeChoice;
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
