<?php
namespace Application\Controller\SlsColissimo;


class customsDeclarations{
	

    /**
     * 
     * @var boolean
     */
    protected $includeCustomsDeclarations;
    
    
    
    /**
     * 
     * @var contents
     */
    protected $contents;
    
    


	/**
	 * @return the $contents
	 */
	public function getContents() {
		return $this->contents;
	}


	/**
	 * @param \Application\Controller\SlsColissimo\contents $contents
	 */
	public function setContents(contents $contents) {
		$this->contents = $contents;
	}

	/**
	 * @return the $includeCustomsDeclarations
	 */
	public function getIncludeCustomsDeclarations() {
		return $this->includeCustomsDeclarations;
	}

	/**
	 * @param boolean $includeCustomsDeclarations
	 */
	public function setIncludeCustomsDeclarations($includeCustomsDeclarations) {
		$this->includeCustomsDeclarations = $includeCustomsDeclarations;
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