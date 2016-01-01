<?php
namespace Colis\Controller;

use Colis\Service\ColisServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
	protected $colisService;
	
	public function __construct(ColisServiceInterface $colisService)
	{
		$this->colisService = $colisService;
	} 
	
	public function deleteAction()
	{
		try{
			
		    $colis = $this->colisService->findColis($this->param('id'));
			
		} catch (\InvalidArgumentException $e) {
			return $this->redirect()->toRoute('list');
		}
		
		
		$request = $this->getRequest();
		
		if ($request->isPost()) 
		{
			$del = $request->getPost('delete_confirmation', 'no');
			
			if ($del === 'yes')
			{
				$this->colisService->deleteColis($colis);
			}
			
			return $this->redirect()->toRoute('list');
		    
		}
		
		return new ViewModel(array('colis' => $colis));    
	}
    
}