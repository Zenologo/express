<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class IndexController extends AbstractActionController
{
    
    
    

    
    public function indexAction()
    {

 
/*       
 *      $colis = new slsColissimo();
        $colis->test();
        die(); 
        
        */
        
        
        
/*         $colis = new colissimo();
        $colis->testColissimo();       
        
        
        die(); */
        
        
        
        $session = new Container("User");
        $nom = $session->offsetGet('email');
        
        return new ViewModel(array('user' => $nom));
    }
    
    
    public function aboutmeAction()
    {
        $session = new Container("User");
        $nom = $session->offsetGet('email');
        
        
    	return new ViewModel(array('nom' => $nom));
    }
    
    
    
    
    

    public function getUserTable()
    {
    	if (!$this->usersTable) {
    		$sm = $this->getServiceLocator();
    		$this->usersTable = $sm->get('Application\Model\UsersTable');
    	}

    	
    	return $this->usersTable;
    }
    
    protected $usersTable;
     
}
