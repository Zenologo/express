<?php
namespace Login;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Session\Container;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    
    public function onBootstrap(MvcEvent $e)
    {
    	$eventManager = $e->getApplication()->getEventManager();
    	$moduleRouteListener = new ModuleRouteListener();
    	$moduleRouteListener->attach($eventManager);
    
    	$serviceManager = $e->getApplication()->getServiceManager();
    
    	$eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
    			$this,
    			'boforeDispatch'
    	), 100);
    	$eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
    			$this,
    			'afterDispatch'
    	), -100);
    	
    	// Config session manager
/*    	$config = $this->getAutoloaderConfig();
    	$sessionConfig = new SessionConfig();
    	$sessionConfig->setOptions($config['session']);
    	$sessionManager = new SessionManager($sessionConfig);
    	$sessionManager->start();
    	Container::setDefaultManager($sessionManager);
 */  	
    }
    
    
    function boforeDispatch(MvcEvent $event){
        
        /*
    	$request = $event->getRequest();
    	$response = $event->getResponse();
    	$target = $event->getTarget ();
    
    	// Offline pages not needed authentication 
    	$whiteList = array ('Login\Controller\Login-index');
    
    	$requestUri = $request->getRequestUri();
    	$controller = $event->getRouteMatch ()->getParam ('controller');
    	$action = $event->getRouteMatch ()->getParam ('action');
    
    	$requestedResourse = $controller . "-" . $action;
    
    	$session = new Container('User');
    
    	if ($session->offsetExists ( 'email' )) {
    		if ($requestedResourse == 'Application\Controller\Login-index' || in_array ( $requestedResourse, $whiteList )) {
    			$url = '/application/index';
    			$response->setHeaders ( $response->getHeaders ()->addHeaderLine ( 'Location', $url ) );
    			$response->setStatusCode ( 302 );
    		}
    	}else{
    
    		if ($requestedResourse != 'Login\Controller\Login' && ! in_array ( $requestedResourse, $whiteList )) {
    			$url = '/';
    			
    			echo "this is module";
    			$response->setHeaders ( $response->getHeaders ()->addHeaderLine ( 'Location', $url ) );
    			$response->setStatusCode ( 302 );
    		}
    		$response->sendHeaders ();
    	}
    
    	//print "Called before any controller action called. Do any operation.";
    	 */
    
    }
    
    
    
    
    
    function afterDispatch(MvcEvent $event){
    	//print "Called after any controller action called. Do any operation.";
    }
    
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
    
    
    public function getServiceConfig()
    {
    	return array(
			'factories' => array(
			    'Login\Model\LoginAuthStorage' => function($sm){
				    return new \Login\Model\LoginAuthStorage("zf_tutorial");
			     }, 
    			'AuthService' => function ($serviceManager) {
    				$adapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
    				$dbAuthAdapter = new DbAuthAdapter ( $adapter, 'users', 'email', 'pwd' );
    				 
    				$auth = new AuthenticationService();
    				$auth->setAdapter ( $dbAuthAdapter );
                    $auth->setStorage($serviceManager->get('Login\Model\LoginAuthStorage'));
    				return $auth;
    			}
			),
    			
    			
    	);
    }
    

}

