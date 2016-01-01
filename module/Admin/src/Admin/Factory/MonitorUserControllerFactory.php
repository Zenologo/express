<?php

namespace Admin\Factory;

use Admin\Controller\MonitorUserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class MonitorUserControllerFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{	    
		$realServiceLocator = $serviceLocator->getServiceLocator();
		
		$userService = $realServiceLocator->get('Admin\Service\UserServiceInterface');
		$userInsertForm = $realServiceLocator->get('FormElementManager')->get('Admin\Form\UserForm');;
		return new MonitorUserController($userService, $userInsertForm);
	}
}

