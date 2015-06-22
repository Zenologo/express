<?php
namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    
    protected $loginService;

    public function __construction(LoginServiceInterface $loginService)
    {
        $this->loginService = $loginService;    
    }
    
    
    public function indexAction()
    {
    	return new ViewModel (array(
    	    'users' => $this->loginService->findAllUses()
    	));
    }


}
