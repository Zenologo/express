<?php
namespace Application\Controller\SlsColissimo;


class sender{
    /**
     * 
     * @var string
     */
	protected $senderParcelRef;
	
	/**
	 * 
	 * @var address
	 */
	protected $address;
	

	/**
	 * @return the $senderParcelRef
	 */
	public function getSenderParcelRef() {
		return $this->senderParcelRef;
	}

	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param string $senderParcelRef
	 */
	public function setSenderParcelRef($senderParcelRef) {
		$this->senderParcelRef = $senderParcelRef;
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