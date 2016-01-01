<?php

// Filename: /src/Colis/Form/ColisForm.php

namespace Colis\Form;

use Zend\Form\Form;

class ColisForm extends Form
{
	public function __construct($name = null, $options = array())
	{
		parent::__construct($name, $options);


		$this->add(array(
			'name' => 'colis-fieldset',
			'type' => 'Colis\Form\ColisFieldset',
			'options' => array(
				'use_as_base_fieldset' => true
			)
		));
		
		$this->add(array(
			'type' => 'submit',
			'name' => 'submit',
			'attributes' => array(
				'value' => 'Insert new colis'
			)
		));
	}
	
}