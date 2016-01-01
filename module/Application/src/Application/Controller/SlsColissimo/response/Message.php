<?php
namespace Application\Controller\SlsColissimo\response;


class Message {
    
    /**
     * 
     * @var string
     */
    protected $id;
    
    /**
     * 
     * @var string
     */
    protected $messageContent;
    
    /**
     * 
     * @var stirng
     */
    protected $type;
    
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $messageContent
	 */
	public function getMessageContent() {
		return $this->messageContent;
	}

	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $messageContent
	 */
	public function setMessageContent($messageContent) {
		$this->messageContent = $messageContent;
	}

	/**
	 * @param \Application\Controller\SlsColissimo\response\stirng $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

    
    
    
    
    
    

	/**
	 * Setter
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function __set($name, $value)
	{
		if ($name === 'getLetterColissimoReturn') {
			return $this->setReturnLetter($value);
		}
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
	
    
    
    
    
    
    
    
}