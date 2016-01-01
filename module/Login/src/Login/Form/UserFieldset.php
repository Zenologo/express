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
    			 'label' => '会员姓名'
    		    )
		));
		
		
		$this->add(array(
    			'type' => 'text',
    		    'name' => 'email',
    		    'options' => array(
    			 'label' => '会员邮箱'
    		    )
		));
		
		$this->add(array(
    			'type' => 'text',
    		    'name' => 'adresse',
    		    'options' => array(
    			 'label' => '详细地址'
    		    )
		));
		
		$this->add(array(
    			'type' => 'text',
    			'name' => 'telephone',
    			'options' => array(
    				 'label' => '联系电话'
    			)
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'pay',
				'options' => array(
					 'label' => '所在国家'
				)
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'pwd',
				'options' => array(
					 'label' => '会员密码'
				)
		));
		
		$this->add(array(
				'type' => 'text',
				'name' => 'admmin',
				'options' => array(
						'label' => '管理员等级'
				)
		));
				
		
		
	}
}