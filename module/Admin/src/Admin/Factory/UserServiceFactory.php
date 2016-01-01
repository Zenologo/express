<?php 
namespace Admin\Factory;

use Admin\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserServiceFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
	    
		return new UserService($serviceLocator->get('Admin\Mapper\UserMapperInterface'));
	}
    
       
}