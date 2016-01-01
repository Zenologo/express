<?php
namespace Application\Controller\SlsColissimo\response;
use Application\Controller\SlsColissimo\response\Message;


abstract  class baseResponse {
	
    protected $messages;
	/**
	 * @return the $messages
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * @param field_type $messages
	 */
	public function setMessages(Message $messages) {
		$this->messages = $messages;
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