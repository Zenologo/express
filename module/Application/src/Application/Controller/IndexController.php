<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use mikehaertl\wkhtmlto\Pdf;


class IndexController extends AbstractActionController
{
    
    private function convert2PDF(){
    	$pdf_base64 = "/Users/Lei/Documents/tt/test.txt";
    	//Get File content from txt file
    	$pdf_base64_handler = fopen($pdf_base64,'r');
    	$pdf_content = fread ($pdf_base64_handler,filesize($pdf_base64));
    	fclose ($pdf_base64_handler);
    	
    	var_dump($pdf_content);
    	
    	//Decode pdf content
    	$pdf_decoded = base64_decode ($pdf_content);
    	
    	
  
    	
    	
    	//Write data back to pdf file
    	$pdf = fopen ('/Users/Lei/Documents/tt/test.pdf','w');
    	fwrite ($pdf,$pdf_decoded);
    	//close output file
    	fclose ($pdf);
    	echo 'pdf is Done';
    
    }
    
    public function indexAction()
    {
        $session = new Container("User");
        $nom = $session->offsetGet('email');
        
        return new ViewModel(array('user' => $nom));
    }
    
    
    protected function getBinary()
    {
    	return '/usr/local/bin/wkhtmltopdf';
    }
    
    
    public function aboutmeAction()
    {
        $session = new Container("User");
        $nom = $session->offsetGet('email');
        
    	return new ViewModel(array('nom' => $nom));
    }
    

    public function getUserTable()
    {
    	if (!$this->usersTable) {
    		$sm = $this->getServiceLocator();
    		$this->usersTable = $sm->get('Application\Model\UsersTable');
    	}

    	
    	return $this->usersTable;
    }
    
    protected $usersTable;
     
}
