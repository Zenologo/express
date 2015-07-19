<?php

namespace Login\Controller;

use Login\Service\UserServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class WriteController extends AbstractActionController
{
	protected $userService;
	protected $userForm;

	public function __construct(UserServiceInterface $userService,
		FormInterface $userForm)
	{
		$this->userService = $userService;
		$this->userForm = $userForm;
	}	

	public function addAction()
	{	    
	    $request = $this->getRequest();
	    $msg = "";
	    
	    if ($request->isPost())
	    {
	        $this->userForm->setData($request->getPost());
   
	        
			if ($this->userForm->isValid() && 
			     !$this->userService->isDuplicateEmail($this->userForm->getData()))
			{
				try{
						$this->userService->saveUser($this->userForm->getData());						
						
						return $this->redirect()->toRoute('application');
				} catch(\Exception $e)
				{
						echo "Some Data Base Error";	
						die();
				}
			} else {
				$msg = "Duplicate Email";
			}
	    }
	    
        return (array('form' => $this->userForm, 'message' => $msg));
	}
	
	
	public function editAction()
	{
		$request = $this->getRequest();
				
		$user = $this->userService->findUser($this->params('id'));
		
		
		$this->userForm->bind($user);
	    
		if ($request->isPost())
		{
			$this->userForm->setData($request->getUser());
			
			if ($this->userForm->isValid())
			{
				try{
					$this->userService->saveUser($user);
					return $this->redirect()->toRoute('login');
				} catch (\Exception $e){

					die($e->getMessage());
				}   
			}
		}
		return new ViewModel(array('form' => $this->userForm));
	}
	
	
	

}
