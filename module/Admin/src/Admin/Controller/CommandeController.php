<?php
namespace Admin\Controller;


use Admin\Service\ColisServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Service\UserServiceInterface;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class CommandeController extends AbstractActionController
{
	protected $colisService;
	protected $userService;
	

	public function __construct(ColisServiceInterface $colisService, UserServiceInterface $userService)
	{
		$this->colisService = $colisService;
		$this->userService = $userService;
	}

	private function isAdmin() {
		$session = new Container("User");
		$admin = $session->offsetGet('admin');
		if (0 < $admin){
			return true;
		}
	
		return false;
	}
	
	public function commandeAction()
	{

	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	     
	    
	    $request = $this->getRequest();
	    
    	if ($request->isPost())
	    {
	       
	        $post = $request->getPost();	        
	        $dateDebut = $post['colis-date-debut'];
	        $dateFin = $post['colis-date-fin'];
	        
	        $dateFin = $dateFin . " 23:59:59";
	        
	    	if ($dateDebut != "" || $dateFin != "")
	    	{
	    	   
	    	    try {
	    			return (array(
	    			    'allColisInfo' => $this->colisService->findAllCommande($dateDebut, $dateFin)
	    			));
	    
	    		} catch (\Exception $e) {
	    			die($e->getMessage());
	    		}
	    	}	    		
	    }
        
        return (array('allColisInfo' => $this->colisService->findAllCommande()));
	}
	
	
	/*
	 * 判断包裹号是否合法
	 */
	private function isValide($refColis)
	{
		if (strlen($refColis) > 0)
		{
		    if ("EY" == substr($refColis, 0, 2) && "FR" == substr($refColis, strlen($refColis) - 2, 2))
		    {
		    	return true;
		    }	
		}
		echo "非法包裹单号";
		return false;
	}
	
	/*
	 * 添加包裹号
	 */
	public function etiquetteAction()
	{
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	    
	    
	    $request = $this->getRequest();
	    $id = $this->params('ref');
	    $colis = "";
	    if ($id != "")
	    {
	       $colis = $this->colisService->findColis($id);	    
	    }
	    	    
	   

	    
	    // 管理员提交了单号
	    if ($request->isPost())
	    {
	        
	        
	    	// $this->params('id')
	    	$post = $request->getPost();

	    	
	    	
	    	$refColis = $post['etiquette'];
	    	echo "old refColis: " . $refColis . "<p>";
	    	$refColis = preg_replace("/\s/","",$refColis);
	    	$refColis = strtoupper($refColis);
	    	echo "new refColis: " . $refColis . "<p>";
	    	    	
	    	if ($this->isValide($refColis))
	    	{		
	    		
	    		//$sold = $user->getCompte();
	    		//$user->setCompte($sold + $montant);
	    
	    		try {
	    		    
	    		    
                    $solde = intval($colis[0]['compte'])  - intval($colis[0]['prixPrevu']) - intval($colis[0]['colisAssurance']);
                    
                    
                    
                    if ($solde < 0)
                    {
                    	return (array("colis"=>$colis[0], "msg"=>"余额不足"));
                    }
                    
                    
	    		    $this->userService->consommerTotal($colis[0]['ref'], $solde);
	    		    
	    		   if (!$this->colisService->saveColisRef($id, $refColis))
	    		   {
	    		   	 die();
	    		   }
	    			 
	    			 
	    			return $this->redirect()->toRoute("admin/commande");
	    			 
	    		} catch (\Exception $e) {
	    			die($e->getMessage());
	    		}
	    	}	 
	    }
	    
	    
	    
	    

	    return (array("colis"=>$colis[0]));
	}
	
	
	public function printAction()
	{   
	    
	    if ( !$this->isAdmin() )
	    {
	    	return $this->redirect()->toUrl('/');
	    }
	    
	    
		$request = $this->getRequest();
	
		$idColis = $this->params('id');
				

		try {
			$view  = new ViewModel();
			$view->setTerminal(true);     //设置不使用layout
			$view->setVariables(array('colisInfo' => $this->colisService->findColis($idColis))); //向view中传参
			return $view;
		} catch (\Exception $e) {
			die($e->getMessage());
		}

		

	
		return (array());
		 
	
	}
	
	
	
	
	

}
