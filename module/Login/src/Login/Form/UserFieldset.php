<?php
namespace  login\Form;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use Login\Model\User;

class UserFieldset extends Fieldset
{
	public function __construct($name = null, $options = array())
	{
	    parent::__construct($name, $options);
	    
	    $this->setHydrator(new ClassMethods(false));
	    $this->setObject(new User());
	    
		$this->add(array(
    	       'type' => 'hidden',
    		    'name' => 'id'
		));
	    
		$this->add(array(
    			'type' => 'text',
    		    'name' => 'nom',
    		    'options' => array(
    			 'label' => 'nom'
    		    )
		));
		
		$this->add(array(
    			'type' => 'text',
    		    'name' => 'prenom',
    		    'options' => array(
    			'label' => 'prenom'
    		    )
		));
		
		$this->add(array(
    			'type' => 'text',
    		    'name' => 'email',
    		    'options' => array(
    			 'label' => 'Email'
    		    )
		));
		
		$this->add(array(
    			'type' => 'text',
    		    'name' => 'adresse',
    		    'options' => array(
    			 'label' => 'Adresse'
    		    )
		));
		
		$this->add(array(
    			'type' => 'text',
    			'name' => 'telephone',
    			'options' => array(
    				 'label' => 'Telephone'
    			)
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'pay',
				'options' => array(
					 'label' => 'Pay'
				)
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'pwd',
				'options' => array(
					 'label' => 'Password'
				)
		));
		
		
	}
}