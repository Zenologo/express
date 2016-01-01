<?php
namespace Application\Controller\SlsColissimo;

use Application\Controller\SlsColissimo\generateLabelRequest;

class generateLabel{
    
    
    /**
     * 
     * @var generateLabelRequest
     */
    protected $generateLabelRequest;
    
    
    
	/**
	 * @return generateLabelRequest
	 */
	public function getGenerateLabelRequest() {
		return $this->generateLabelRequest;
	}

	/**
	 * @param generateLabelRequest $generateLabelRequest
	 */
	public function setGenerateLabelRequest(generateLabelRequest $generateLabelRequest) {
		$this->generateLabelRequest = $generateLabelRequest;
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