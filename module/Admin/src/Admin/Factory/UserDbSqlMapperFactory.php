<?php
namespace Admin\Factory;

use Admin\Mapper\UserDbSqlMapper;
use Admin\Model\User;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserDbSqlMapperFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new UserDbSqlMapper($serviceLocator->get('Zend\Db\Adapter\Adapter'),
				new ClassMethods(false),
				new User());
	}
}