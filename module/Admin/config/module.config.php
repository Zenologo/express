<?php
return array(
    
    'controllers' => array(
        'factories' => array(
        		'Admin\Controller\Monitor' => 'Admin\Factory\MonitorControllerFactory',
                'Admin\Controller\Write' => 'Admin\Factory\WriteControllerFactory',
                'Admin\Controller\Delete' => 'Admin\Factory\DeleteControllerFactory',
                'Admin\Controller\MonitorUser' => 'Admin\Factory\MonitorUserControllerFactory',
                'Admin\Controller\Commande' => 'Admin\Factory\CommandeControllerFactory'
        ),
    ),
    
    
    'service_manager' => array(
		'factories' => array(
			'Admin\Mapper\ColisMapperInterface' => 'Admin\Factory\ColisDbSqlMapperFactory',
			'Admin\Service\ColisServiceInterface' => 'Admin\Factory\ColisServiceFactory',
		    'Admin\Service\UserServiceInterface' => 'Admin\Factory\UserServiceFactory',
		    'Admin\Mapper\UserMapperInterface' => 'Admin\Factory\UserDbSqlMapperFactory',
		    'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
		    
		),
    ),
    
    
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Monitor',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    
                    'add' => array(
                    		'type'    => 'Literal',
                    		'options' => array(
                    				'route'    => '/add',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\Write',
                    						'action'     => 'add',
                    				),
                    		),
                    ),

                    'commande' => array(
                    		'type'    => 'Literal',
                    		'options' => array(
                    				'route'    => '/commande',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\Commande',
                    						'action'     => 'commande',
                    				),
                    		),
                    ),
                    
                    'print' => array(
                    		'type'    => 'Segment',
                    		'options' => array(
                    				'route'    => '/print/:id',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\Commande',
                    						'action'     => 'print',
                    				),
                        		    'constraints' => array(
                        		    		'id' => '\d+',
                        		    )
                    		),
                    ),
                    
                    
                    'etiquette' => array(
                    		'type'    => 'Segment',
                    		'options' => array(
                    				'route'    => '/etiquette[/:ref]',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\Commande',
                    						'action'     => 'etiquette',
                    				),

                    		),
                    ),
                    
                    'delete' => array(
                    		'type'    => 'segment',
                    		'options' => array(
                    				'route'    => '/delete/:id',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\Delete',
                    						'action'     => 'delete',
                    				),
                    				'constraints' => array(
                    						'id' => '\d+'
                    				)
                    		),
                    ),
                    
                    
                    'user' => array(
                    		'type'    => 'Literal',
                    		'options' => array(
                    				'route'    => '/user',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\MonitorUser',
                    						'action'     => 'allusers',
                    				),
                    		),
                    ),
                    
                    'recharge' => array(
                    		'type'    => 'Segment',
                    		'options' => array(
                    				'route'    => '/recharge/:id[/:montant]',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\MonitorUser',
                    						'action'     => 'recharge',
                    				),
                    		        'constraints' => array(
                    					'id' => '\d+',
                    		            'montant' => 'd+'
                    				),
                    		),
                    ),

                    'resetpwd' => array(
                    		'type'    => 'Segment',
                    		'options' => array(
                    				'route'    => '/resetpwd/:id',
                    				'defaults' => array(
                    						'controller' => 'Admin\Controller\MonitorUser',
                    						'action'     => 'resetpwd',
                    				),
                    				'constraints' => array(
                    						'id' => '\d+',
                    						'montant' => 'd+'
                    				),
                    		),
                    ),
                    
                    
                    
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
    ),
);
