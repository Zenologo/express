<?php

namespace Colis\Controller;

use Colis\Service\ColisServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use mikehaertl\wkhtmlto\pdf;


class ListController extends AbstractActionController
{
	protected $colisService;
		
	public function __construct(ColisServiceInterface $colisService)
	{
		$this->colisService = $colisService;
	}	
	
	private function getCountryCode($country)
	{
	   $codePay = array(
	          "Afghanistan"=>"AF",
    "Afrique_Centrale"=>"Afrique_Centrale",
	"Afrique_du_sud"=>"ZA",
    "Albanie"=>"AL","Algerie"=>"DZ","Allemagne"=>"DE",
    "Andorre"=>"AD","Angola"=>"AO","Anguilla"=>"AI",
    "Arabie_Saoudite"=>"SA","Argentine"=>"AR","Armenie"=>"AM",
    "Australie"=>"AU","Autriche"=>"AT",
    "Bahamas"=>"BS","Bangladesh"=>"BD","Barbade"=>"BB",
    "Bahrein"=>"BH","Belgique"=>"BE","Belize"=>"BZ","Benin"=>"BJ",
    "Bermudes"=>"BM","Bolivie"=>"BO",
    "Botswana"=>"BW","Bhoutan"=>"BT","Boznie_Herzegovine"=>"BA",
    "Bresil"=>"BR","Brunei"=>"BN","Bulgarie"=>"BG","Burkina_Faso"=>"BF",
    "Burundi"=>"BI", "Cambodge"=>"KH","Cameroun"=>"CM",
    "Canada"=>"CA", "Cap_vert"=>"CV","Chili"=>"CL",
    "Chine"=>"CN" ,"Chypre"=>"CY" ,"Colombie"=>"CO","Comores"=>"KM",
    "Congo"=>"CG","Congo_democratique"=>"CD","Cook"=>"CK",
    "Coree_du_Nord"=>"KR","Coree_du_Sud"=>"KP","Costa_Rica"=>"CR",
    "Cote_d_Ivoire"=>"CI","Croatie"=>"HR","Cuba"=>"CU","Danemark"=>"DK",
    "Djibouti"=>"DJ","Dominique"=>"DO","Egypte"=>"EG",
    "Emirats_Arabes_Unis"=>"AE","Equateur"=>"EC","Erythree"=>"ER",
    "Espagne"=>"ES","Estonie"=>"EE","Etats_Unis"=>"US","Ethiopie"=>"ET",
    "Falkland"=>"FK","Feroe"=>"FO","Fidji"=>"FJ","Finlande"=>"FI",
    "France"=>"FR","Gabon"=>"GA","Gambie"=>"GM","Georgie"=>"GE",
    "Ghana"=>"GH","Gibraltar"=>"GI","Grece"=>"GR","Grenade"=>"GD",
    "Groenland"=>"GL","Guadeloupe"=>"GP","Guam"=>"GU","Guatemala"=>"GT",
    "Guernesey"=>"GG","Guinee"=>"GN","Guinee_Bissau"=>"GW",
    "Guyana"=>"GY","Guyane_Francaise "=>"GF",
    "Haiti"=>"HT", "Honduras"=>"HN","Hong_Kong"=>"HK",
    "Hongrie"=>"HU","Inde"=>"IN","Indonesie"=>"ID","Iran"=>"IR","Iraq"=>"IQ",
    "Irlande"=>"IE","Islande"=>"IS","Israel"=>"IL","Italie"=>"IT","Jamaique"=>"JM",
    "Japon"=>"JP","Jersey"=>"JE","Jordanie"=>"JO",
    "Kazakhstan"=>"KZ","Kenya"=>"KE","Kirghizstan"=>"KG","Kiribati"=>"KI",
    "Koweit"=>"KW","Laos"=>"LA","Lesotho"=>"LS","Lettonie"=>"LV","Liban"=>"LB",
    "Liberia"=>"LR","Liechtenstein"=>"LI","Lituanie"=>"LT" ,"Luxembourg"=>"LU",
    "Lybie"=>"Lybie","Macao"=>"MO","Macedoine"=>"MK","Madagascar"=>"MG","Madère"=>"Madère",
    "Malaisie"=>"MY","Malawi"=>"MW","Maldives"=>"MV","Mali"=>"ML","Malte"=>"MT",
    "Mariannes du Nord"=>"MP","Maroc"=>"MA","Marshall"=>"MH","Martinique"=>"MQ",
    "Maurice"=>"MU","Mauritanie"=>"MR","Mayotte"=>"YT","Mexique"=>"MX","Micronesie"=>"FM",
    "Midway"=>"Midway","Moldavie"=>"Moldavie","Monaco"=>"MC","Mongolie"=>"MN","Montserrat"=>"MS",
    "Mozambique"=>"MZ","Namibie"=>"NA","Nauru"=>"NR","Nepal"=>"NP","Nicaragua"=>"NI",
    "Niger"=>"NE","Nigeria"=>"NG","Niue"=>"NU","Norfolk"=>"NF","Norvege"=>"NO",
    "Nouvelle_Caledonie"=>"NC","Nouvelle_Zelande"=>"NZ","Oman"=>"OM",
    "Ouganda"=>"UG","Ouzbekistan"=>"UZ","Pakistan"=>"PK","Palau"=>"Palau","Palestine"=>"Palestine",
    "Panama"=>"PA","Papouasie_Nouvelle_Guinee"=>"PG","Paraguay"=>"PY",
    "Pays_Bas"=>"NL","Perou"=>"PE","Philippines"=>"PH" ,"Pologne"=>"PL","Polynesie"=>"PF",
    "Porto_Rico"=>"PR","Portugal"=>"PT","Qatar"=>"QA","Republique_Dominicaine"=>"Republique_Dominicaine",
    "Republique_Tcheque"=>"CZ","Reunion"=>"RE","Roumanie"=>"RO","Royaume_Uni"=>"GB",
    "Russie"=>"RU","Rwanda"=>"RW","Sahara Occidental"=>"EH","Sainte_Lucie"=>"LC",
    "Saint_Marin"=>"SM","Salomon"=>"SB","Salvador"=>"Salvador","Samoa_Occidentales"=>"WS",
    "Samoa_Americaine"=>"AS","Sao_Tome_et_Principe"=>"ST" ,"Senegal"=>"SN",
    "Seychelles"=>"SC","Sierra Leone"=>"SL","Singapour"=>"SG","Slovaquie"=>"SK",
    "Slovenie"=>"SI","Somalie"=>"SO","Soudan"=>"SD" ,"Sri_Lanka"=>"LK" ,"Suede"=>"SE",
    "Suisse"=>"CH","Surinam"=>"SR","Swaziland"=>"SZ","Syrie"=>"SY","Tadjikistan"=>"TJ",
    "Taiwan"=>"TW","Tonga"=>"TO","Tanzanie"=>"TZ","Tchad"=>"TD","Thailande"=>"TH",
    "Togo"=>"TG" ,"Trinite_et_Tobago"=>"TT",
    "Tunisie"=>"TN","Turkmenistan"=>"TM" ,"Turquie"=>"TR",
    "Ukraine"=>"UA","Uruguay"=>"UY","Vanuatu"=>"VU", "Venezuela"=>"VE",
    "Vietnam"=>"VN",
    "Wallis et Futuma"=>"WF","Yemen"=>"YE","Yougoslavie"=>"YU","Zambie"=>"ZM",
    "Zimbabwe"=>"ZW" 
	    );
	    
	    
	    
	    return $codePay[$country];
	    
	    
	    $country = str_replace(' ', '', $country);
	    $country = strtoupper($country);
	    
		switch ($country){
			case 'HONGKONG' : return 'HK';
			case 'TAIWAN': return 'TW';
			case 'CHINE' : return 'CN';
			case 'CHINA' : return 'CN';
			case 'SINGAPOUR': return 'SG';
			case 'FRANCE': return 'FR';
			default: return 'CN'; 
		}
	}
	
	private function getAmountTotal($weight, $insurance){
		// CN23上的价格，与真实价格无关
	    $prix = array('1'=>22.34, '2'=>30.63, '3'=>40.65 , '4'=>43.06, '5'=>45.27,
	                   '6'=>62.7, '7'=>70.44, '8'=>78.06, '9'=>81.35, '10'=>85.41,
	                   '15'=>127.71, '20'=>136.94, '25'=>175.80, '30'=>202.6);
	    
	    return (($prix[$weight] + $insurance) * 100);
	}
	
	private function estSuffisant($email, $colisId)
	{
	    $colisInfo = $this->colisService->findColis($colisId);
	    
	    $userSolde = intval($this->colisService->getSolde($email));
	    $fraisColis = intval($colisInfo->getColisAssurance()) + intval($colisInfo->getPrixPrevu());
	    	    
	    if ($fraisColis < ($userSolde-100))
	    {
	    	return true;
	    }
	    $this->flashmessenger()->addMessage("notSolde");
	    return false;
	}
	
	public function indexAction()
	{ 	    
	    
	    $session = new Container("User");
	    $email = $session->offsetGet('email');
	    if ('' == $email)
	    {
	       $this->redirect()->toRoute('login');
	    }
	    
	    $request = $this->getRequest();
	    $colisId = $this->params('id');	        
	    
	    if ($colisId <> '' && $this->estSuffisant($email, $colisId))
	    {           
	        // 找出包裹信息
	        $colis = $this->colisService->findColis($colisId);
	        $articles = $this->colisService->findArticles($colisId);
	        
	        if ($colis->getRefColis()  == ''){
	        	// Sender
	            $colissimo = new \Application\Controller\slsColissimo();
                $colissimo->setSenderAdresse($colis->getExpediteurAdresse());
                $colissimo->setSenderCity($colis->getExpediteurVille());
                $colissimo->setSenderName($colis->getExpediteurNom());
                $colissimo->setSenderTelephone($colis->getExpediteurTelephone());
                $colissimo->setSenderZipCode($colis->getExpediteurCodePostale());
                
                // Destinateur 
                $colissimo->setAddresseeAddrese($colis->getDestinateurAdresse());
                $colissimo->setAddresseeCity($colis->getDestinateurVille());
                $countryCode = $this->getCountryCode($colis->getDestinateurPay());
                
                                
                $colissimo->setAddresseeCountryCode($countryCode);
                $colissimo->setAddresseeMobileNumber($colis->getDestinateurTelephone());
                $colissimo->setAddresseeName($colis->getDestinateurNom());
                $colissimo->setAddresseeZipCode($colis->getDestinateurCodePostale());
	        	
                
                // 设置包裹清单信息                               

                $colissimo->setArticleDescriptif($colis->getColisGenre());
                $colissimo->setArticleDecelaration($articles);
                
                

                //$colissimo->setArticleValue($colis->getColisValue());
                $colissimo->setArticleValue(80);
                $weight = $colis->getPoidsPrevu();
                $colissimo->setArticleWeight($weight);
                
                $colissimo->setInsurance($colis->getColisAssurance());
                
                $amountTotal = $this->getAmountTotal($weight, $colis->getColisAssurance());
                
//                echo  '<p>' . $weight . ' $ ' . $colis->getColisAssurance() . "amount total: " . $amountTotal . "<p>";
    
                $colissimo->setAmountTotal($amountTotal);
                
                
                $colissimo->test();
                $codeID = $colissimo->getId(); 
                
                //echo "codeID: " . $codeID . "<p>";                
                
                if ($codeID == 0)
                {
                    $parcelNum = $colissimo->getParcelNum();
                    $pdfUrl = $colissimo->getPdfUrl();
                   //echo "url: " . $pdfUrl . "<p> parcelnum: " . $parcelNum;
                    $this->colisService->udpateRefColis($colisId, $parcelNum, $pdfUrl, $email);
                }
                
	        }

	         
	        $allColis = $this->colisService->findAllByClient($email);
	        $solde = $allColis['solde'];	        
	        unset($allColis['solde']);
	         
	        return (array("allColis" => $allColis, "solde" => $solde));
	    }

	    
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
	    					'allColis' => $this->colisService->findColisByDate($email, $dateDebut, $dateFin),
	    					'prixPrevu' => $this->colisService->calculPrixPrevuByDate($email, $dateDebut, $dateFin),
	    					'assurance' => $this->colisService->calculAssuranceByDate($email, $dateDebut, $dateFin),
	    			        'solde' => $this->colisService->getSolde($email),
	    			));
	    			 
	    		} catch (\Exception $e) {
	    			die($e->getMessage());
	    		}
	    	}
	    	echo "form is not valid";
	    	 
	    }
	    
	    
	    $allColis = $this->colisService->findAllByClient($email);
	    $solde = $allColis['solde'];
	    unset($allColis['solde']);	     
	      
	    return (array("allColis" => $allColis, "solde" => $solde));
	}
	
	public function detailAction()
	{
	    $id = $this->params()->fromRoute('id');
	    
	    try {
	    	
	        $colis = $this->colisService->findColis($id);
	    } catch (\InvalidArgumentException $ex){
	    	return $this->redirect()->toRoute('\colis');
	    }
	    
		return new ViewModel(array('colis' => $colis));
	}
	
	public function telechargerAction(){	    
	    
	    $request = $this->getRequest();
	    $idColis = $this->params('id');
	    
	    if ($idColis > 0){
	           
	        $inFile = "http://express.localhost/colis/recu/" . $idColis;
	        $outFile =  'st-recu-' . $idColis . '.pdf';
	        
	        $pdf = new Pdf($inFile);
	        $pdf->binary = '/usr/local/bin/wkhtmltopdf';
	        $pdf->send($outFile,false);
	    }

	}
	
	
	public function recuAction()
	{	   
	     	    
	    $request = $this->getRequest();	    
	    $idColis = $this->params('id');
	    
	    if ($idColis > 0){
    	    try {
    	    	$view  = new ViewModel();
    	    	$view->setTerminal(true);     //设置不使用layout
    	    	$view->setVariables(array('colisInfo' => $this->colisService->findColis($idColis))); //向view中传参
    	    	return $view;
    	    } catch (\Exception $e) {
    	    	die($e->getMessage());
	    }
	    }else{
	       return $this->redirect()->toRoute('\colis');
	    }
	}
	
	
	
}



