<?php
// Filename: src/Colis/Controller/WriteController.php

/*
	Modify router in file module.config.php
*/


namespace Colis\Controller;

use Colis\Service\ColisServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Colis\Model\Colis;
use Zend\Session\Container;

class WriteController extends AbstractActionController
{
	protected $colisService;
	protected $colisForm;
	
	public function __construct(ColisServiceInterface $colisService, 
			FormInterface $colisForm)
	{	    
		$this->colisService = $colisService;
		$this->colisForm = $colisForm;	
	}

	private function isMember()
	{
	   $session = new Container('User');
	   $nom = $session->offsetGet('nom');
	   if ($nom == "")
	       return false;
	   return true;    
	}
	
		
	public function addAction()
	{	

	    $session = new Container('User');
	    $id = $session->offsetGet('id');
	    
	    $email = $session->offsetGet('email');
	    $client = $this->colisService->getClientInfoByEmail($email);
	     
	    $compte = $client["compte"];
	    $message = '';
	    
	    if ($id == ''){
	    	$this->redirect()->toRoute('login');
	    }
	    
	    $vip = $client["vip"];
	    $vip = "v" . $vip;
	    
		$request = $this->getRequest();	
		
		if ($request->isPost()) {
		    
		    $post = $request->getPost();	       	

		    $articles = array(
		    	'descript1' => $post['descript1'],
		        'descript2' => $post['descript2'],
		        'descript3' => $post['descript3'],
		        'descript4' => $post['descript4'],
		        'descript5' => $post['descript5'],
		        'descript6' => $post['descript6'],
		        'descript7' => $post['descript7'],
		        'descript8' => $post['descript8'],
		        'descript9' => $post['descript9'],
		        'descript10' => $post['descript10'],
		        
		        'quantity1' => $post['quantity1'],
		        'quantity2' => $post['quantity2'],
		        'quantity3' => $post['quantity3'],
		        'quantity4' => $post['quantity4'],
		        'quantity5' => $post['quantity5'],
		        'quantity6' => $post['quantity6'],
		        'quantity7' => $post['quantity7'],
		        'quantity8' => $post['quantity8'],
		        'quantity9' => $post['quantity9'],
		        'quantity10' => $post['quantity10'],
		        
		        'poids1' => $post['poids1'],
		        'poids2' => $post['poids2'],
		        'poids3' => $post['poids3'],
		        'poids4' => $post['poids4'],
		        'poids5' => $post['poids5'],
		        'poids6' => $post['poids6'],
		        'poids7' => $post['poids7'],
		        'poids8' => $post['poids8'],
		        'poids9' => $post['poids9'],
		        'poids10' => $post['poids10'],
		        
		        'valeur1' => $post['valeur1'],
		        'valeur2' => $post['valeur2'],
		        'valeur3' => $post['valeur3'],
		        'valeur4' => $post['valeur4'],
		        'valeur5' => $post['valeur5'],
		        'valeur6' => $post['valeur6'],
		        'valeur7' => $post['valeur7'],
		        'valeur8' => $post['valeur8'],
		        'valeur9' => $post['valeur9'],
		        'valeur10' => $post['valeur10'],
		    );
		    		    		    
		    $data = array('expediteurNom' => $post['expediteur-nom'],
		      'expediteurAdresse' => $post['exp-adresse'],
		      'expediteurTelephone' => $post['exp-telephone'],
		      'expediteurVille' => $post['exp-ville'],
		      'expediteurCodePostale' => $post['exp-code-postale'],
		      'destinateurNom' => $post['destinateur-nom'],
		      'destinateurTelephone' => $post['dest-telephone'],
		      'destinateurAdresse' => $post['dest-adresse'],
		      'destinateurVille' => $post['dest-ville'],
		      'destinateurCodePostale' => $post['dest-code-postale'],
		      'destinateurPay' => $post['dest-pay'],
 		      'colisGenre' => $post['colis-genre'],
		      'poidsPrevu' => $post['colis-poinds-prevu'],
		      'colisAssurance' => $post['colis-assurance'],
		      // 在插入数据库时需要重新计算总额  
		      'depotMode'=> $post['depot-mode'],
		      'vip' => $vip,
    	      'articles' => $articles,
		    );		    
		    
			try {
      		    if (false == $this->colisService->saveColisArray($data))
      		    {
      		        $message = "您的余额不足，请充值后下单";	
      		       
      		    }else{
      		        return $this->redirect()->toRoute('colis');      		    	
      		    }

			} catch (\Exception $e) {
			    var_dump($data);
				echo "下单失败，请将此代码发邮件给管理员，谢谢！";
                die();
			}
			
		}
		
		$prix = $this->colisService->findAllPrix();
		$ads = $this->colisService->findAds($id);
		
		return new ViewModel(array('form' => $this->colisForm, 'prix' => $prix, 
		    'vip'=>$vip, 'allAds'=>$ads, 'message'=>$message, ));
	}
	
	public function editAction()
	{
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

