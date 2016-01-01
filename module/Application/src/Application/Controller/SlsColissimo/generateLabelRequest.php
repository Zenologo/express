<?php
namespace Application\Controller\SlsColissimo;

use Application\Controller\SlsColissimo\outputFormat;
use Application\Controller\SlsColissimo\letter;


class generateLabelRequest
{
    /**
     * 
     * @var string
     */
    protected $contractNumber;

    
    
    /**
     *
     * @var string
     */
    protected $password;
               
    
    
    /**
     * 
     * @var outputFormat
     */
    protected $outputFormat;
    
    /**
     * 
     * @var letter
     */
    protected $letter;
    
    
  public function __construct(outputFormat $outputFormat = null){
  	$this->outputFormat = $outputFormat;
  }
    
    
    
    
	/**
	 * @return contractNumber
	 */
	public function getContractNumber() {
		return $this->contractNumber;
	}

	/**
	 * @return password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @return the $outputFormat
	 */
	public function getOutputFormat() {
		return $this->outputFormat;
	}

	/**
	 * @return the $letter
	 */
	public function getLetter() {
		return $this->letter;
	}



	/**
	 * @param string $contractNumber
	 */
	public function setContractNumber($contractNumber) {
		$this->contractNumber = $contractNumber;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @param outputFormat $outputFormat
	 */
	public function setOutputFormat(outputFormat $outputFormat) {
		$this->outputFormat = $outputFormat;
	}

	/**
	 * @param field_type $letter
	 */
	public function setLetter(letter $letter) {
		$this->letter = $letter;
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