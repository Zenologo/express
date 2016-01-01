<?php
namespace Login\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
	public function __construct($name)
	{
		parent::__construct($name);
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'email',
		    'type' => 'text',
		    'options' => array(
			    'label' => '邮箱',
		        'id' => 'email',
		        'placeholder' => 'example@google.com'
		)
		));
	
	   $this->add(array(
	   	   'name' => 'pwd',
	       'type' => 'password',
	       'options' => array(
	       	   'label' => '密码',
	           'id' => 'pwd',
	           'placeholder' => '*************'
	       )
	   ));
	   
	   $this->add(array(
	   	   'type' => 'Zend\Form\Element\Csrf',
	       'name' => 'loginCsrf',
	       'options' => array(
	   	       'csrf_options' => array(
	       	       'timeout' => 3600
	            )
	       )
	   ));
	
	   $this->add(array(
	   	   'name' => 'submit',
	       'attributes' => array(
	   	       'type' => 'submit',
	           'value' => '提交',
	       ),
	   ));
	}    
}