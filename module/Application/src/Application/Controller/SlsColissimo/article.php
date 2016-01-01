<?php
namespace Application\Controller\SlsColissimo;


class article{
	
    /**
     * 
     * @var string
     */
    protected $description;
    
    /**
     * 
     * @var integer
     */
    protected $quantity;
    
    
    /**
     * 
     * @var float
     */
    protected $weight;
    
    
    /**
     * 
     * @var float
     */
    protected $value;
    
    /**
     * 
     * @var string
     */
//    protected $hsCode;
    
    /**
     * 
     * @var string
     */
    protected $originCountry;
    
    
    
    
    
    
    
    
    /**
	 * @return the $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return the $quantity
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @return the $weight
	 */
	public function getWeight() {
		return $this->weight;
	}

	/**
	 * @return the $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return the $hsCode
	 
	public function getHsCode() {
		return $this->hsCode;
	}*/

	/**
	 * @return the $originCountry
	 */
	public function getOriginCountry() {
		return $this->originCountry;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param number $quantity
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}

	/**
	 * @param number $weight
	 */
	public function setWeight($weight) {
		$this->weight = $weight;
	}

	/**
	 * @param number $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * @param string $hsCode
	 
	public function setHsCode($hsCode) {
		$this->hsCode = $hsCode;
	}*/

	/**
	 * @param string $originCountry
	 */
	public function setOriginCountry($originCountry) {
		$this->originCountry = $originCountry;
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