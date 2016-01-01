<?php
namespace Admin\Controller;

use Admin\Service\ColisServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class DeleteController extends AbstractActionController
{
	protected $colisService;
	
	
	
	public function __construct(ColisServiceInterface $colisService)
	{
		$this->colisService = $colisService;
	} 
	
	private function isAdmin() {
		$session = new Container("User");
		$admin = $session->offsetGet('admin');
		if (0 < $admin){
			return true;
		}
	
		return false;
	}
	
	public function deleteAction()
	{   
	    
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	    
	    
	    
		try{		    
		    $colis = $this->colisService->findColis($this->params('id'));			
		} catch (\InvalidArgumentException $e) {
		    
		    echo "Can't find id " . $this->param('id');
			return $this->redirect()->toRoute('Monitor');
		}
		
		$request = $this->getRequest();
		
		if ($request->isPost()) 
		{
			$del = $request->getPost('delete_confirmation', 'no');
			
			if ($del === 'yes')
			{
				$this->colisService->deleteColis($colis);
			}
			
			return $this->redirect()->toRoute('admin');
			
		    
		}
		
		return new ViewModel(array('colis' => $colis));    
	}
    
}