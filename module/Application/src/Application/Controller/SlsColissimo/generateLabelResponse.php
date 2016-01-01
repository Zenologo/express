<?php
namespace Application\Controller\SlsColissimo;

use Application\Controller\SlsColissimo\response\GenerateLabelResponseType;

class generateLabelResponse
{
    
    protected $return;    

	/**
	 * @return the $return
	 */
	public function getReturn() {
		return $this->return;
	}

	/**
	 * @param field_type $return
	 */
	public function setReturn(GenerateLabelResponseType $return) {
		$this->return = $return;
	}

	/**
	 * Is response successful ?
	 *
	 * @return boolean
	 */
	public function isSuccess()
	{
		if ($this->return instanceof GenerateLabelResponseType
		&& $this->return->errorID === 0) {
			return true;
		}
		return false;
	}
	
	/**
	 * Get error message
	 *
	 * @return string
	 */
	public function getErrorMessage()
	{
		if ($this->return instanceof GenerateLabelResponseType
		&& $this->return->errorID !== 0) {
			return $this->return->error;
		}
	}
	
	
	/**
	 * Setter
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function __set($name, $value)
	{
	    
	    echo "generateLabelResponse return  __set:  " . $name . "<p>";
		if ($name === 'return') {
			return $this->setReturn($value);
		}
	}    
}