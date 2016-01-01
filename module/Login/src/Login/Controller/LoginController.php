<?php
namespace Login\Controller;

use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Login\Form\LoginForm;
use Login\Form\LoginFilter;
use Login\Utility\UserPassword;
use Zend\Mvc\Controller\AbstractActionController;
use Login\Service\UserServiceInterface;



class LoginController extends AbstractActionController
{
	protected $storage;
	protected $authservice;
	protected $userService;
	
	public function __construct(UserServiceInterface $userService)
	{
	   $this->userService = $userService;	
	}
	
	
	
	
	private function isAdmin($email)
	{
		$admin = $this->userService->isAdmin($email);
	    if (0 == $admin)
	    {
		    $session = new Container("User");
            $session->offsetSet('email', $email);
            $session->offsetSet('admin', "0");
	        return false; 
	    }
	    
	    $session = new Container("User");
	    $session->offsetSet('email', $email);
	    $session->offsetSet('admin', $admin);
	    return true;
	    
	}
	
	
	
	
	public function loginAction()
	{
	    
		$request = $this->getRequest();
		
		$view = new ViewModel();
		$loginForm = new LoginForm('loginForm');
	    $loginForm->setInputFilter(new LoginFilter());
	    $message = "";
	    
	    if ($request->isPost())
	    {
	       $data = $request->getPost();
	       $loginForm->setData($data);
	       
	       
	       if ($loginForm->isValid())
	       {
    	       $data = $loginForm->getData();
	           
    	      //$userPassword = new UserPassword();
	           //$encyptPass = $userPassword->create($data['pwd']);	           

    	       
	           $this->getAuthService()
	           ->getAdapter()
	           ->setIdentity($data['email'])
	           ->setCredential($data['pwd']);
	           
	           $result = $this->getAuthService()->authenticate();
	           
	           if ($result->isValid())
	           {
	               
	               $userInfo = $this->userService->findUserByEmail($data['email']);
	               
	               $session = new Container("User");
	               $session->offsetSet('email', $userInfo['email']);
	               $session->offsetSet('nom', $userInfo['nom']);
	               $session->offsetSet('vip', $userInfo['vip']);
	               $session->offsetSet('admin', $userInfo['admin']);
	               $session->offsetSet('id', $userInfo['id']);
	               $session->offsetSet('compte', $userInfo['compte']);
	               
	               //$this->flashMessenger()->addMessage(array('success' => 'Login Success'));
	               //$message
	               
	               if (0 < $userInfo['admin'])
	               {   
	                   return $this->redirect()->toUrl("/admin");
	                   //return array("loginForm" => $loginForm, "error"=>$loginForm->getMessages());
	               }else{
	                   $this->redirect()->toUrl('/');
	               }
	           }else{
	           	   $message = '邮箱和密码不匹配';
	           }   
	       }
	    }
	    return array("loginForm" => $loginForm, "error"=>$message);
	}
	
	
	private function getAuthService()
	{
		if (! $this->authservice) {
			$this->authservice = $this->getServiceLocator()->get('AuthService');
		}
		return $this->authservice;
	}
	
	public function logoutAction(){
		$session = new Container('User');
		$session->getManager()->destroy();
		$this->getAuthService()->clearIdentity();
	    return $this->redirect()->toUrl("/");
	}
    
    
    
}