<?php
namespace Application\Controller\SlsColissimo;

class outputFormat
{    
    /**
     * 
     * @var integer
     */
	protected $x;
	
	
	/**
	 * 
	 * @var integer
	 */
	protected $y;
	
	/**
	 * 
	 * @var string
	 */
	protected $outputPrintingType;
	
	

	/**
	 *
	 * @var string
	 */
	protected $returnType;

	
	
	/**
	 * Contructor
	 *
	 * @param outputFormat $outputFormat
	 */
	public function __construct($x = null, $y = null, $outputPrintingType = null)
	{
	    $this->x = 0;
	    $this->y = 0;
		$this->outputPrintingType = "PDF_A4_300dpi";
	}
	
	
    
	

	/**
	 * @return x
	 */
	public function getX() {
		return $this->x;
	}

	/**
	 * @return y
	 */
	public function getY() {
		return $this->y;
	}

	/**
	 * @return outputPrintingType
	 */
	public function getOutputPrintingType() {
		return $this->outputPrintingType;
	}

	/**
	 * @return returnType
    */	 
	public function getReturnType() {
		return $this->returnType;
	}

	/**
	 * @param number $x
	 */
	public function setX($x) {
		$this->x = $x;
	}

	/**
	 * @param number $y
	 */
	public function setY($y) {
		$this->y = $y;
	}

	/**
	 * @param string $outputPrintingType
	 */
	public function setOutputPrintingType($outputPrintingType) {
		$this->outputPrintingType = $outputPrintingType;
	}

	/**
	 * @param string $returnType
	 */
	public function setReturnType($returnType) {
		$this->returnType = $returnType;
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