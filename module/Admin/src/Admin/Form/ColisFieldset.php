<?php

namespace Admin\Form;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use Admin\Model\Colis;

class ColisFieldset extends Fieldset
{
	public function __construct($name = null, $options = array())
	{

		parent::__construct($name, $options);
			
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
						'label' => 'Expediteur Nom'
				)
		));
			
		$this->add(array(
				'type' => 'text',
				'name' => 'expediteurAdresse',
				'options' => array(
						'label' => 'Expediteur Adresse'
				)
		));


		$this->add(array(
				'type' => 'text',
				'name' => 'expediteurVille',
				'options' => array(
						'label' => 'Expediteur Ville'
				)
		));


		$this->add(array(
				'type' => 'text',
				'name' => 'expediteurCodePostale',
				'options' => array(
						'label' => 'Expediteur Code Postale'
				)
		));

		$this->add(array(
				'type' => 'text',
				'name' => 'expediteurTelephone',
				'options' => array(
						'label' => 'Expediteur Code Postale'
				)
		));

		$this->add(array(
				'type' => 'text',
				'name' => 'destinateurNom',
				'options' => array(
						'label' => 'Destinateur Nom'
				)
		));
			

		$this->add(array(
				'type' => 'text',
				'name' => 'destinateurAdresse',
				'options' => array(
						'label' => 'Destinateur Adresse'
				)
		));
			
			
		$this->add(array(
				'type' => 'text',
				'name' => 'destinateurVille',
				'options' => array(
						'label' => 'Destinateur Ville'
				)
		));
			
			
		$this->add(array(
				'type' => 'text',
				'name' => 'destinateurCodePostale',
				'options' => array(
						'label' => 'Destinateur Code Postale'
				)
		));
			

		$this->add(array(
				'type' => 'text',
				'name' => 'destinateurTelephone',
				'options' => array(
						'label' => 'Destinateur Telephone'
				)
		));

		$this->add(array(
				'type' => 'text',
				'name' => 'refColis',
				'options' => array(
						'label' => 'Reference Colis'
				)
		));

		$this->add(array(
				'type' => 'text',
				'name' => 'refSTColis',
				'options' => array(
						'label' => 'Reference ST Colis'
				)
		));
		

	}


}
