<?php
namespace Login\Form;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter
{
	public function __construct()
	{
		
	    $isEmpty = \Zend\Validator\NotEmpty::IS_EMPTY;
	    $invalidEmail = \Zend\Validator\EmailAddress::INVALID_FORMAT;
	    
	    $this->add(array(
	    	'name' => 'email',
	        'required' => true,
	        'filters' => array(
	    	    array('name' => 'StripTags'),
	            array('name' => 'StringTrim'),
	        ),
	        'validators' => array(
	            array(
	            		'name' => 'NotEmpty',
	            		'options' => array(
	            			'messages' => array($isEmpty => '邮箱不能为空')
	            		),
	            		'break_chain_on_failre' => true
	            ),
	            array(
	        	  'name' => 'EmailAddress',
	                'options' => array(
	        	  	   'messages' => array(
	                	  $invalidEmail => '无效邮箱地址',
	                )
	        	  )  	
	        	),
	        ),
	        
	    ));
	    
	    $this->add(array(
	    	'name' => 'pwd',
	        'required' => true,
	        'filters' => array(
	            array('name' => 'StripTags'),
	            array('name' => 'StringTrim')
	        ),
	        'validators' => array(
	        	array(
	            'name' => 'NotEmpty',
	            'options' => array(
	        	  'messages' => array(
	        	      $isEmpty => '密码不能为空'
	        	  )
	            )
	           )
	        )
	    ));
	}
}