<?php
namespace Application\Controller\SlsColissimo;

class category{
	
    /**
     * 
     * @var integer
     */
    protected $value;
	/**
	 * @return the $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param number $value
	 */
	public function setValue($value) {
		$this->value = $value;
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