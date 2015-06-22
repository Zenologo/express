<?php
return array(
    // This lines opens the configuration for RouteManager
    'router' => array(
        // Open configuration for all possible routes
    		'routes' => array(
    		    // Define a new route called 'login'
    				'login' => array(
    					   // Define the routes type to be 'literal' which is basically	
    				    'type' => 'Zend\Mvc\Router\Http\Literal',
    						// Configure the route itself 
    				    'options' => array(
    				                // Listen to 'login' as uri
    						        'route'    => '/login',
    				                // Define default controller and action to be called when this route is matched
    								'defaults' => array(
    										'controller' => 'login\Controller\Index',
    										'action'     => 'index',
    								),
    						),
    				),
    		),
      ),
      'controllers' => array(
            'factories' => array (
      	         'Login\Controller\Index' => 'Login\Factory\IndexControllerFactory'
            ), 								
    	),
    	
    'view_manager' => array(
	   'template_path_stack' => array(
    	   __DIR__ . '/../view',
        ), 
    ),
    
    'service_manager' => array(
    	'invokable' => arrray(
    		'Login\Service\Indexservicev = 'Index\Service\Interface\' ''	
    	)
    	
    	
    	
    	
    );   
    }
);
