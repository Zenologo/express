<?php
namespace Login\Factory;

use Login\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
	    
	    
	   
		return new UserService($serviceLocator->get('Login\Mapper\UserMapperInterface'));
	}
    
    
    
}