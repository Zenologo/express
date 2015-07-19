<?php
namespace Login\Model;

use Zend\Authentication\Storage;


class LoginAuthStorage extends Storage\Session
{
	public function setRmemberMe($remember = 0, $time = 1209600)
	{
		if ($remember == 1)
		{
		    $this->session->getManager()->rememberMe($time);
		}
	}
	
	public function forgetMe()
	{
		$this->session->getManager()->forgetMe();
	}
    

	
    
}