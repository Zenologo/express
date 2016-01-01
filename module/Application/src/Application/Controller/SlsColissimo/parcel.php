<?php
namespace Application\Controller\SlsColissimo;

class parcel{

	
	
    protected $insuranceValue; 
    
//    protected $recommendationLevel;
    
    /**
     * 
     * @var float
     */    protected $weight;
    
    /**
     * 
     * @var boolean
     */
    protected $nonMachinable = 0;


//    protected $COD = 0;
    
//    protected $CODAmount = 0;
    
    protected $returnReceipt = 1;

//    protected $instructions = '';
    
    protected $ftd = 0;
	
	
	
	
	/**
	 * @return the $weight
	 */
	public function getWeight() {
		return $this->weight;
	}



	/**
	 * @param number $weight
	 */
	public function setWeight($weight) {
		$this->weight = $weight;
	}
	


	/**
	 * @return the $insuranceValue
	 */
	public function getInsuranceValue() {
		return $this->insuranceValue;
	}

	/**
	 * @return the $recommendationLevel
	 
	public function getRecommendationLevel() {
		return $this->recommendationLevel;
	}
*/



	/**
	 * @return the $nonMachinable
	 */
	public function getNonMachinable() {
		return $this->nonMachinable;
	}

	/**
	 * @return the $COD
	 
	public function getCOD() {
		return $this->COD;
	}*/

	/**
	 * @return the $CODAmount
	 */
/* 	public function getCODAmount() {
		return $this->CODAmount;
	} */

	/**
	 * @return the $returnReceipt
	 */
	public function getReturnReceipt() {
		return $this->returnReceipt;
	}

	/**
	 * @return the $instructions
	 */
/* 	public function getInstructions() {
		return $this->instructions;
	} */

	/**
	 * @return the $ftd
	 */
	public function getFtd() {
		return $this->ftd;
	}

	/**
	 * @param field_type $insuranceValue
	 */
	public function setInsuranceValue($insuranceValue) {
		$this->insuranceValue = $insuranceValue;
	}

	/**
	 * @param field_type $recommendationLevel
	 
	public function setRecommendationLevel($recommendationLevel) {
		$this->recommendationLevel = $recommendationLevel;
	}
    */
	
	
	
	/**
	 * @param boolean $nonMachinable
	 */
	public function setNonMachinable($nonMachinable) {
		$this->nonMachinable = $nonMachinable;
	}

	/**
	 * @param number $COD
	 */
	public function setCOD($COD) {
		$this->COD = $COD;
	}

	/**
	 * @param number $CODAmount
	 */
/* 	public function setCODAmount($CODAmount) {
		$this->CODAmount = $CODAmount;
	} */

	/**
	 * @param number $returnReceipt
	 */
	public function setReturnReceipt($returnReceipt) {
		$this->returnReceipt = $returnReceipt;
	}

	/**
	 * @param string $instructions
	 */
/* 	public function setInstructions($instructions) {
		$this->instructions = $instructions;
	} */

	/**
	 * @param number $ftd
	 */
	public function setFtd($ftd) {
		$this->ftd = $ftd;
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
