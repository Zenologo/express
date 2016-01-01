<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;


use Admin\Service\ColisServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class MonitorController extends AbstractActionController
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

    public function indexAction()
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
    
    				$s = $this->colisService->calculPrixPrevuByDate($dateDebut, $dateFin);
    
    				return (array(
    						'allColisInfo' => $this->colisService->findColisByDate($dateDebut, $dateFin),
    						'prixPrevu' => $this->colisService->calculPrixPrevuByDate($dateDebut, $dateFin),
    						'assurance' => $this->colisService->calculAssuranceByDate($dateDebut, $dateFin),
    				));
    
    			} catch (\Exception $e) {
    				die($e->getMessage());
    			}
    		}
    		echo "form is not valid";
    
    	}
    	    
    	return (array('allColisInfo' => $this->colisService->findAllColis()));
    }
    
    
    
    
    
    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /monitor/monitor/foo
        return array();
    }
}
