<?php
// Filename: src/Colis/Controller/WriteController.php

/*
	Modify router in file module.config.php
*/


namespace Admin\Controller;

use Admin\Service\ColisServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;



class WriteController extends AbstractActionController
{
	protected $colisService;
	protected $colisForm;
	
	
	public function __construct(ColisServiceInterface $colisService, FormInterface $colisForm)
	{
		$this->colisService = $colisService;		
		$this->colisForm = $colisForm;	
	}
	
	private function isAdmin() {
		$session = new Container("User");
		$admin = $session->offsetGet('admin');
		if (0 < $admin){
			return true;
		}
	
		return false;
	}

	public function addAction()
	{       
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	    
	    
	    
	    
	    $request = $this->getRequest();
	
		if ($request->isPost()) {
			$this->colisForm->setData($request->getPost());
			
			if ($this->colisForm->isValid()){
				try {
					$this->colisService->saveColis($this->colisForm->getData());
					return $this->redirect()->toRoute('admin');
				} catch (\Exception $e) {
					echo "some DB Error happened, log it and let the user know";
				}
			}
		}		
		
		
		if ($this->colisForm == null)
		{
			echo "colisform is null <p>";
		
		}
		
		

		return new ViewModel(array('form' => $this->colisForm));
	}
	
	public function editAction()
	{
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	    
	    
	    
		$request = $this->getRequest();
		$colis = $this->colisService->findColis($this->params('id'));
		
		$this->colisForm->bind($colis);
		
		if ($request->isPost())
		{
			$this->colisForm->setData($request->getPost());
			
			if ($this->colisForm->isValid())
			{
				try {
					$this->colisService->saveColis($colis);
					return $this->redirect()->toRoute("/");
				
				} catch (\Exception $e) {
					die($e->getMessage());
				}
			}
			
		}
		
		return new ViewModel(array('form' => $this->colisForm));
		
		
	}

}

