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
    									'controller' => 'Login\Controller\Login',
    									'action'     => 'login',
    								),
    						),
							'may_terminate' => true,
							'child_routes' => array(
								'detail' => array(
    								'type' => 'segment', 
    								'options' => array(
    									'route' => '/:id',
    									'defaults' => array(
    										'action' => 'detail'	
    									),
    									'constraints' => array(
    										'id' => '\d+'
    									)
    								)
								),

							    'introduction' => array(
							    		'type' => 'literal',
							    		'options' => array(
							    				'route' => '/introduction',
							    				'defaults' => array(
							    						'controller' => 'Login\Controller\Index',
							    						'action' => 'intromembre'
							    				),
							    		),
							    ), // membre introduction
							    
							    'list' => array(
							    		'type' => 'literal',
							    		'options' => array(
							    				'route' => '/list',
							    				'defaults' => array(
							    						'controller' => 'Login\Controller\Index',
							    						'action' => 'index'
							    				),
							    		),
							    ), // list
							    
							    'add' => array(
									'type' => 'literal',
									'options' => array(
										'route' => '/add',
										'defaults' => array(
										    'controller' => 'Login\Controller\Write',
										    'action' => 'add'
									    ),
									),
								), // add
							    
							    'edit' => array(
	                               'type' => 'segment',
							        'options' => array(
							            'route' => '/edit[/:id]',
							            'defaults' => array(
							        	    'controller' => 'Login\Controller\Write',
							                'action' => 'edit' 
							             ), 
							            'constraints' => array(
	                                       'id' => '\d+'
                                        )
							        )
                                ), // edit
                                
							    'delete' => array(
							    		'type' => 'segment',
							    		'options' => array(
							    				'route' => '/delete/:id',
							    				'defaults' => array(
							    						'controller' => 'Login\Controller\Delete',
							    						'action' => 'delete'
							    				),
							    				'constraints' => array(
							    						'id' => '\d+'
							    				)
							    		)
							    ), // delete
							    
							)
    				),
    		),
      ),
      'controllers' => array(
          'invokables' => array(
          		'Login\Controller\Login' => 'Login\Controller\LoginController'
          ),
          'factories' => array (
      	         'Login\Controller\Index' => 'Login\Factory\IndexControllerFactory',
                 'Login\Controller\Write' => 'Login\Factory\WriteControllerFactory',
                 'Login\Controller\Delete' => 'Login\Factory\DeleteControllerFactory',
          ), 
    	),    
    'view_manager' => array(
    		'template_path_stack' => array(
    			__DIR__ . '/../view',
    		),
    ),
    
    'service_manager' => array(
	   'factories' => array(
	       'Login\Service\UserServiceInterface' => 'Login\Factory\UserServiceFactory',
	       'Login\Mapper\UserMapperInterface' => 'Login\Factory\ZendDbSqlMapperFactory',
	       'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        ),  	
	),
    'db' => array(
	   'driver' => 'Pdo',
       'username' => 'root',
        'password' => '',
        'dsn' => 'mysql:dbname=express;host=localhost',
        'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
    ),    

    
);
