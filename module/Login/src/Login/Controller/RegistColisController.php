<?php
namespace Login\Controller;

use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Login\Form\LoginForm;
use Login\Form\LoginFilter;
use Login\Utility\UserPassword;
use Zend\Mvc\Controller\AbstractActionController;

class RegistColisController extends AbstractActionController
{
	protected $storage;
	protected $authservice;
	
	public function registcolisAction()
	{
	    
		$request = $this->getRequest();
		
		$view = new ViewModel();
		$loginForm = new LoginForm('loginForm');
	    $loginForm->setInputFilter(new LoginFilter());
	    
	    if ($request->isPost())
	    {
	       $data = $request->getPost();
	       $loginForm->setData($data);
	       
	       if ($loginForm->isValid())
	       {
    	       $data = $loginForm->getData();
	           
//    	       $userPassword = new UserPassword();  	       
//	           $encyptPass = $userPassword->create($data['pwd']);
	           
	        
	           
	           
	           $this->getAuthService()
	           ->getAdapter()
	           ->setIdentity($data['email'])
	           ->setCredential($data['pwd']);
	           
	           $result = $this->getAuthService()->authenticate();
	           
	           if ($result->isValid())
	           {
	               echo "this is valid ". __LINE__ ."<p>";
	               $session = new Container("User");
	               $session->offsetSet('email', $data['email']);
	               $session->offsetSet('by', 'zenologo');	               
	               
	               echo "Get session getOffset: " . $session->offsetGet('by') . "<p>";
	               
	               $this->flashMessenger()->addMessage(array('success' => 'Login Success'));
	               
	               $this->redirect()->toUrl('/');
	           	
	           }else{
	               echo "this is not valid ". __LINE__ ."<p>";
	           	   $this->flashmessenger()->addMessage(array('error' => 'invalid credentials'));
	           }
	           
	           echo "there is  ". __LINE__ . "<p>";
	           
	           
	           return $this->redirect()->toUrl("/");
	           
	       }else{
	           echo "line ". __LINE__ . "<p>";
	       	   $errors = $loginForm->getMessages();
	       }
	    }
	    echo "line ". __LINE__ . "<p>";
	    $view->setVariable('loginForm', $loginForm);  
	    return $view;
	}
    
    
}