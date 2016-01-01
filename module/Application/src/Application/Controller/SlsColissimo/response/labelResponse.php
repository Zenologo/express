<?php
namespace Application\Controller\SlsColissimo\response;



class labelResponse {

    
    /**
     * 
     * @var string
     */
    protected $label;
    
    /**
     * 
     * @var Base64
     */
    protected $cn23;
    
    /**
     * 
     * @var string
     */
    protected $parcelNumber;
    
    
    /**
     * 
     * @var stirng
     */
    protected $parcelNumberPartner;    
    
    
    /**
     * 
     * @var unknown
     */
    protected $pdfUrl;
    
    
    
    /**
	 * @return the $label
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @return the $cn23
	 */
	public function getCn23() {
		return $this->cn23;
	}

	/**
	 * @return the $parcelNumber
	 */
	public function getParcelNumber() {
		return $this->parcelNumber;
	}

	/**
	 * @return the $parcelNumberPartner
	 */
	public function getParcelNumberPartner() {
		return $this->parcelNumberPartner;
	}

	/**
	 * @return the $pdfUrl
	 */
	public function getPdfUrl() {
		return $this->pdfUrl;
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * @param \Zend\XmlRpc\Value\Base64 $cn23
	 */
	public function setCn23($cn23) {
		$this->cn23 = $cn23;
	}

	/**
	 * @param string $parcelNumber
	 */
	public function setParcelNumber($parcelNumber) {
		$this->parcelNumber = $parcelNumber;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\stirng $parcelNumberPartner
	 */
	public function setParcelNumberPartner($parcelNumberPartner) {
		$this->parcelNumberPartner = $parcelNumberPartner;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\unknown $pdfUrl
	 */
	public function setPdfUrl($pdfUrl) {
		$this->pdfUrl = $pdfUrl;
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