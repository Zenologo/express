<?php

// Filename: /src/Colis/Form/ColisFieldset.php

namespace Colis\Form;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use Colis\Model\Colis;

class ColisFieldset extends Fieldset
{
		public function __construct($name = null, $options = array())
		{
			
			
			parent::__construct($name, $options );
			
			$this->setHydrator(new ClassMethods(false));
			$this->setObject(new Colis());
			
			
			$this->add(array(
				'type' => 'hidden',
				'name' => 'id'
			));
		
		
			$this->add(array(
				'type' => 'text',
				'name' => 'expediteurNom',
				'options' => array(
					'label' => '发件人姓名'
				)
			));
			
			$this->add(array(
				'type' => 'text',
				'name' => 'expediteurAdresse',
				'options' => array(
					'label' => '发件人地址'
				)
			));
				
	
			$this->add(array(
				'type' => 'text',
				'name' => 'expediteurVille',
				'options' => array(
					'label' => '发件人城市'
				)
			));

	
			$this->add(array(
				'type' => 'text',
				'name' => 'expediteurCodePostale',
				'options' => array(
					'label' => '发件人邮编'
				)
			));
	
			$this->add(array(
				'type' => 'text',
				'name' => 'expediteurTelephone',
				'options' => array(
					'label' => '发件人电话'
				)
			));
	
			$this->add(array(
				'type' => 'text',
				'name' => 'destinateurNom',
				'options' => array(
					'label' => '收件人姓名'
				)
			));
			

			$this->add(array(
				'type' => 'text',
				'name' => 'destinateurAdresse',
				'options' => array(
					'label' => '收件人地址'
				)
			));
			
			
			$this->add(array(
				'type' => 'text',
				'name' => 'destinateurVille',
				'options' => array(
					'label' => '收件人城市'
				)
			));
			
			
			$this->add(array(
				'type' => 'text',
				'name' => 'destinateurCodePostale',
				'options' => array(
					'label' => '收件人邮编'
				)
			));
			

			$this->add(array(
					'type' => 'text',
					'name' => 'destinateurPay',
					'options' => array(
							'label' => '收件人国家'
					)
			));
			
			
	
			$this->add(array(
				'type' => 'text',
				'name' => 'destinateurTelephone',
				'options' => array(
					'label' => '收件人电话'
				)
			));
	
			
			$this->add(array(
					'type' => 'text',
					'name' => 'poidsPrevu',
					'options' => array(
							'label' => '包裹估重'
					)
			));
			
			$this->add(array(
				'type'=>'text',
			    'name' => 'colisAssurance',
			    'options' => array(
				    'lable' => '保险金额'
			     )
			    
			));
			
			$this->add(array(
					'type'=>'text',
					'name' => 'colisGenre',
					'options' => array(
							'lable' => '物品类型'
					)
					 
			));
			
		}
	
	
}

