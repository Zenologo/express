<?php
namespace Application\Controller\SlsColissimo;


class letter {
    
    /**
     * 
     * @var service
     */
	protected $service;
	
	/**
	 * 
	 * @var parcel
	 */
	protected $parcel;
	
	/**
	 * 
	 * @var customsDeclarations
	 */
	protected $customsDeclarations;
	
	/**
	 * 
	 * @var sender
	 */
	protected $sender;
	
	/**
	 * 
	 * @var addressee
	 */
	protected $addressee;
	
	
	
	/**
	 * @return the $service
	 */
	public function getService() {
		return $this->service;
	}

	/**
	 * @return the $parcel
	 */
 	public function getParcel() {
		return $this->parcel;
	} 

	/**
	 * @return the $customsDeclarations
	 */
	public function getCustomsDeclarations() {
		return $this->customsDeclarations;
	}

	/**
	 * @return the $sender
	 */
	public function getSender() {
		return $this->sender;
	}

	/**
	 * @return the $addressee
	 */
	public function getAddressee() {
		return $this->addressee;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\service $service
	 */
	public function setService(service $service) {
		$this->service = $service;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\parcel $parcel
	 */
 	public function setParcel(parcel $parcel) {
		$this->parcel = $parcel;
	} 

	/**
	 * @param \Application\Controller\SlsColissimo\customsDeclarations $customsDeclarations
	 */
	public function setCustomsDeclarations(customsDeclarations $customsDeclarations) {
		$this->customsDeclarations = $customsDeclarations;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\sender $sender
	 */
	public function setSender(sender $sender) {
		$this->sender = $sender;
	}
	
	/**
	 * @param \Application\Controller\SlsColissimo\addressee $addressee
	 */
	public function setAddressee(addressee $addressee) {
		$this->addressee = $addressee;
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