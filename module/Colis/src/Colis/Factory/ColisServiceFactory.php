<?php


namespace Colis\Factory;

use Colis\Service\ColisService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;



class ColisServiceFactory implements FactoryInterface
{
		public function createService(ServiceLocatorInterface $serviceLocator)
		{
			return new ColisService(
					$serviceLocator->get('Colis\Mapper\ColisMapperInterface')
			);
		}
	
}