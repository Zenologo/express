<?php
namespace Login\Factory;

use Login\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$realServiceLocator = $serviceLocator->getServiceLocator();
	    return new IndexController($realServiceLocator->get('Login\Service\UserServiceInterface'));	    
	}
	
	
	
	
}