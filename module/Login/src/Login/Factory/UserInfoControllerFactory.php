<?php
namespace Login\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Login\Controller\UserInfoController;

class UserInfoControllerFactory implements FactoryInterface
{
    
    
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$realServiceLocator = $serviceLocator->getServiceLocator();
		return new UserInfoController($realServiceLocator->get('Login\Service\UserServiceInterface'));
	}
}
