<?php
namespace Admin\Form;

use Zend\Form\Form;

class UserForm extends Form
{
	public function __construct($name = null, $options = array())
	{
		parent::__construct($name, $options);
	  
		$this->add(array(
				'name' => 'user-fieldset',
				'type' => 'Admin\Form\UserFieldset',
				'options' => array(
						'use_as_base_fieldset' => true
				)
		));

		

		
		
		$this->add(array(
				'type' => 'submit',
				'name' => 'submit',
				'attributes' => array(
						'value' => '确定'
				)

		));
	  
	}

}