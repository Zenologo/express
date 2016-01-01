<?php

namespace Colis\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Colis\Controller\ListController;

class ListControllerFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$realServiceLocator = $serviceLocator->getServiceLocator();
		$colisService = $realServiceLocator->get('Colis\Service\ColisServiceInterface');
			
		return new ListController($colisService);
	}
	
	
}

