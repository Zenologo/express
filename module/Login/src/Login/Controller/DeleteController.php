<?php
namespace Login\Controller;

use Login\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
	protected $userService;
	
	public function __construct(UserServiceInterface $userService)
	{
		$this->userService = $userService;
	}
    
    public function deleteAction()
    {
    	try {
    		$user = $this->userService->findUser($this->params('id'));
    	}catch (\InvalidArgumentException $e){
    		return $this->redirect()->toRoute('login');
    	}
    	
    	$request = $this->getRequest();
    	
    	if ($request->isPost())
    	{
    		$del = $request->getPost('delete_confirmation', 'no');
    		
    		if ($del === 'yes')
    		{
    			$this->userService->deleteUser($user);
    		}
    		return $this->redirect()->toRoute('login');
    	    
    	}
    	
    	return new ViewModel(array('user' => $user));
        
    }
    
}