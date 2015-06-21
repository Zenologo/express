<?php
namespace Login;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory
     * @return array
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     */
    public function getAutoloaderConfig()
    {
    	return array(
    		'Zend\Loader\StandardAutoloader' => array(
    		  'namespaces' => array(
    			// Autoload all classes from namespace 'Login' form '/module/Login/src/Login'
    			__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
    		)
    	   )
    	);
        
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }	
    
    

}

