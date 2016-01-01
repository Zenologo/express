<?php
namespace Login\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Login\Controller\LoginController;

class LoginControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
	    $realServiceLocator = $serviceLocator->getServiceLocator();
		return new LoginController($realServiceLocator->get('Login\Service\UserServiceInterface'));
	}   
}
