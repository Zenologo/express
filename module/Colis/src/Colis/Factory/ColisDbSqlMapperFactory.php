<?php
namespace Colis\Factory;

use Colis\Mapper\ColisDbSqlMapper;
use Colis\Model\Colis;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ColisDbSqlMapperFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new ColisDbSqlMapper($serviceLocator->get('Zend\Db\Adapter\Adapter'),
		    new ClassMethods(false),
		    new Colis());	
	}
  
    
}