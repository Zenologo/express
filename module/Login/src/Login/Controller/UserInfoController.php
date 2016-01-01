<?php
namespace Login\Controller;

use Login\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class UserInfoController extends AbstractActionController
{
    
    protected $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
    	$this->userService = $userService;
    }
    
    
    public function listAdsAction()
    {
    	$session = new \Zend\Session\Container("User");
    	$id = $session->offsetGet('id');

    	if ($id != '')
    	{
    	    
    	    $request = $this->getRequest();
    	    
    	    if ($request->isPost()){
    	    	$post = $request->getPost();
    	    	$post['userId'] = $id;
    	    	$this->userService->addAdresse($post);	
    	    } 
    	   
    		return (array('allAds' => $this->userService->findAllAds($id)));
    	}else{
    		return $this->redirect()->toRoute('login');
    	}
    	return;
    }
    
    
    

    
    
    public function addAction()
    {
        return new ViewModel(array());
    }
    
    public function editAction()
    {
        return new ViewModel(array());
    }
    
    public function deleteAction ()
    {
        $session = new \Zend\Session\Container("User");
        $userId = $session->offsetGet('id');
        
        if ($userId != '')
        {    
        	$colisId = $this->params('id');	
        	if ($colisId != ''){
        	    if ($this->userService->deleteAdresse($colisId, $userId))
        	    {
        	       $this->redirect()->toRoute('login/listads');
        	    }
        	}        
        }else{
        	$this->redirect()->toRoute('login');
        }
        return array("error" => "删除失败，请与管理员联系");
    	
    }
    
    
    public function modifAction()
    {
        $session = new \Zend\Session\Container("User");
        $userId = $session->offsetGet('id');
        
        if ($userId == null){
            return $this->redirect()->toRoute('login');
        }
                
	    $request = $this->getRequest();
	    
	    if ($request->isPost()){
	    	
	        $data = $request->getPost();
	        
	        if ($data['password'] != $data['check_password']){
	           return (array('info' => $this->userService->findUser($userId)));
	        }
	        	        
            $this->userService->updateUserInfo($data);
            return $this->redirect()->toUrl('/');	         
	    }    	    

	    return (array('info' => $this->userService->findUser($userId)));
    }
    
    private function isVide($post){
    	foreach ($post as $p){
    	
    	}
    }
    
    public function listExpAdsAction()
    {
        $session = new \Zend\Session\Container("User");
        $id = $session->offsetGet('id');
        
        if ($id != '')
        {
        	$request = $this->getRequest();
        		
        	if ($request->isPost()){
        		$post = $request->getPost();
        		$post['userId'] = $id;
        		$post['expediteur'] = 1;
        		$post['expediteur_pays'] = "France";
        		$this->userService->addExpAdresse($post);
        		$request->setContent(array());
        	}
        
        	return (array('allAds' => $this->userService->findAllExpAds($id)));
        }else{
        	return $this->redirect()->toRoute('login');
        }
        return;
    }
    
    
    public function deleteexpadsAction ()
    {
    	$session = new \Zend\Session\Container("User");
    	$userId = $session->offsetGet('id');
    
    	if ($userId != '')
    	{
    		$colisId = $this->params('id');
    		if ($colisId != ''){
    			if ($this->userService->deleteAdresse($colisId, $userId))
    			{
    				$this->redirect()->toRoute('login/listexpads');
    			}
    		}
    	}else{
    		$this->redirect()->toRoute('login');
    	}
    	return array("error" => "删除失败，请与管理员联系");
    	 
    }
    
    
    
    
}

