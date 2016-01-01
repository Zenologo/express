<?php


namespace Admin\Factory;

use Admin\Service\ColisService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ColisServiceFactory implements FactoryInterface
{
		public function createService(ServiceLocatorInterface $serviceLocator)
		{
		    $colisService = $serviceLocator->get('Admin\Mapper\ColisMapperInterface');
			return new ColisService($colisService);
		}
	
}