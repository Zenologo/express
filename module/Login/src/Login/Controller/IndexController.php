<?php
namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Login\Service\UserServiceInterface;
use Zend\Session\Container;



class IndexController extends AbstractActionController
{

    protected $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;	
    }



    public function indexAction()
    {
        
        $session = new Container("User");
        echo "this is login/loginAction";
        echo "test session, email: " . $session->offsetGet('email') . "<p>";
        echo "test session, nom : " . $session->offsetGet('nom') . "<p>";
        echo "test session, by " . $session->offsetGet('by') . "<p>";
        
        $data = $this->getServiceLocator()->get('AuthService')->getStorage()->read();
        print_r($data);
        
        die();
        
        return array('users'=>$this->userService->findAllUser());      
    }
    
    public function intromembreAction()
    {
        echo "this is intromembreAction";
    	return array('introduction' => 'ok');
    }

    
}