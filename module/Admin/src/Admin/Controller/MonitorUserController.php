<?php
namespace Admin\Controller;


use Admin\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\FormInterface;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class MonitorUserController extends AbstractActionController
{
	protected $userService;
	protected $userForm;
	

	public function __construct(UserServiceInterface $userService, 
                                 FormInterface $form)
	{
		$this->userService = $userService;
		$this->userForm = $form;
	}

	private function isAdmin() {
		$session = new Container("User");
		$admin = $session->offsetGet('admin');
		if (0 < $admin){
			return true;
		}
	
		return false;
	}

	public function allusersAction()
	{
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	     
	    
		return (array('allUsers' => $this->userService->findAllUser()));
	}

	
	public function rechargeAction($msg)
	{	    
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	    
	    $request = $this->getRequest();
	    $user = $this->userService->findUser($this->params('id'));
	       
	    if ($request->isPost())
	    {
	        $post = $request->getPost();	        
	        $montant = $post['montant'];
	        
	    	    $sold = $user->getCompte();    
	    	    $user->setCompte($sold + $montant);	 
                if ($montant >= 200 && $montant < 1000){
                	$user->setVip(1);
                }else if ($montant >= 1000){
                	$user->setVip(2);
                }
                
	    	    try {	    		    
	    			$this->userService->saveUser($user);
	    			return $this->redirect()->toRoute("admin/user");
	    
	    		} catch (\Exception $e) {
	    			die($e->getMessage());
	    		}
	    		
	    }
	    
	    return new ViewModel(array('user' => $user));	    
	}
	
	
	
	public function resetpwdAction()
	{

	    $request = $this->getRequest();
	    $userId = $this->params('id');
	     
	     if ($userId != '')
	     {
	         $this->userService->resetPWD($userId);	     		         
	     }

	     $this->flashmessenger()->addMessage('ok');
	     
	   return $this->redirect()->toRoute('admin/user', array('controller'=>'MonitorUser', 'action'=>'recharge'));
       return $this->redirect()->toUrl('/admin/user');
	}
	
	
}
