<?php
return array(
    'controllers' => array(
        'factories' => array(
           // 'Colis\Controller\Skeleton' => 'Colis\Factory\ListControllerFactory',
            'Colis\Controller\List' => 'Colis\Factory\ListControllerFactory',    
            'Colis\Controller\Write' => 'Colis\Factory\WriteControllerFactory',
            
        ),
    ),
    'service_manager' => array(
		'factories' => array(
            'Colis\Mapper\ColisMapperInterface' => 'Colis\Factory\ColisDbSqlMapperFactory',
		    'Colis\Service\ColisServiceInterface' => 'Colis\Factory\ColisServiceFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
		),
    ),    
  
    'router' => array(
        'routes' => array(
            'colis' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/colis[/:id]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Colis\Controller',
                        'controller'    => 'Colis\Controller\List',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                    		'id' => '\d+'
                    ),
                ),
                
                'may_terminate' => true,
                'child_routes' => array(
                    
                    'add' => array(
                    		'type'    => 'Literal',
                    		'options' => array(
                    				'route'    => '/add',
                    				'defaults' => array(
                    						'controller' => 'Colis\Controller\Write',
                    						'action'     => 'add',
                    				),
                    		),
                    ),
                    
                    
                    'edit' => array(
                    		'type'    => 'segment',
                    		'options' => array(
                    				'route'    => '/edit/:id',
                    				'defaults' => array(
                    						'controller' => 'Colis\Controller\Write',
                    						'action'     => 'edit',
                    				),
                    		 'constraints' => array(
                    			 'id' => '\d+'
                    		)  
                    	),
                    ),
                    
                    'delete' => array(
                    		'type'    => 'segment',
                    		'options' => array(
                    				'route'    => '/delete/:id',
                    				'defaults' => array(
                    						'controller' => 'Colis\Controller\Delete',
                    						'action'     => 'delete',
                    				),
                    				'constraints' => array(
                    						'id' => '\d+'
                    				)
                    		),
                    ),

                    // 打印凭证
                    'recu' => array(
                    		'type'    => 'segment',
                    		'options' => array(
                    				'route'    => '/recu[/:id]',
                    				'defaults' => array(
                    						'controller' => 'Colis\Controller\List',
                    						'action'     => 'recu',
                    				),
                    				'constraints' => array(
                    						'id' => '\d+'
                    				)
                    		),
                    ),
                    
                    // 打印凭证
                    'telecharger' => array(
                    		'type'    => 'segment',
                    		'options' => array(
                    				'route'    => '/telecharger[/:id]',
                    				'defaults' => array(
                    						'controller' => 'Colis\Controller\List',
                    						'action'     => 'telecharger',
                    				),
                    				'constraints' => array(
                    						'id' => '\d+'
                    				)
                    		),
                    ),
                    
                    
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Colis' => __DIR__ . '/../view',
        ),
    ),
    

);
