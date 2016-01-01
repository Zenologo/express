<?php
namespace Colis\Mapper;

use Colis\Model\ColisInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Select;
use Zend\Session\Container;
use Zend\Db\Sql\Predicate;
//use Zend\Db\Sql\Predicate\PredicateSet;
use Zend\Db\ResultSet\ResultSet;


class ColisDbSqlMapper implements ColisMapperInterface
{
	protected $dbAdapter;
	protected $hydrator;
	protected $colisPrototype;

	
	public function __construct(AdapterInterface $dbAdapter,
		                       HydratorInterface $hydrator, 
	                           ColisInterface $colisPrototype)
	{
		$this->dbAdapter = $dbAdapter;
		$this->hydrator = $hydrator;
		$this->colisPrototype = $colisPrototype;
	}
	
	
	public function findAllByClient($email)
	{
	    $client =  $this->getClientInfo();
	    $sql = new Sql($this->dbAdapter);
	    $select = $sql->select('colis');
	    $select->where(array('clientId = ?' => $client['id']));	   
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	    
        if ($result instanceof ResultInterface && $result->isQueryResult())
		{            
		    		    
			$resultSet = new HydratingResultSet($this->hydrator, $this->colisPrototype);
			
			
			$compte = $this->getClientCompteById($client['id']);						
			$result = $resultSet->initialize($result)->toArray();
			$result['solde'] = $compte;				

			return  $result;
		}	
		
		return array();		
	    
	}
	
	
	public function findColisByDate($email, $dateDebut, $dateFin)
	{
		$client = $this->getClientInfoByEmail($email);
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('colis');
		$select->where(array('clientId=?'=>$client['id'], 'depotTime >= ?' => $dateDebut, 'depotTime <= ?' => $dateFin), 
	        Predicate\PredicateSet::OP_AND);
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		
		if ($result instanceof ResultInterface && $result->isQueryResult())
		{
			$resultSet = new HydratingResultSet($this->hydrator, $this->colisPrototype);
			return $resultSet->initialize($result);
		}
		return array();
	}
	
	
	public function find($id)
	{
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('colis');
		$select->where(array('id = ?' => $id));
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();

		if ($result instanceof ResultInterface && 
					$result->isQueryResult() && 
	                $result->getAffectedRows())
		{
			return $this->hydrator->hydrate($result->current(), $this->colisPrototype);
		}
		
		throw new \InvalidArgumentException("Colis with given ID:($id) not");
		
	}
	
	public function findAll()
	{   
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('colis');
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();		
		
		if ($result instanceof ResultInterface && $result->isQueryResult())
		{            
		    		    
			$resultSet = new HydratingResultSet($this->hydrator, $this->colisPrototype);
			
			return  $resultSet->initialize($result);
		}	
		
		echo "Database is empty";
		
		return array();		
	}
	

	private function getClientInfo()
	{
	    $session = new Container("User");
	    $email = $session->offsetGet('email');
	    
		$action = new Select("users");
		$action->where(array('email = ?' => $email));
		$sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    
	    if ($result->isQueryResult()){
	        $row = $result->current();
	    	return $row;
	    }
	    
	    return "";
	}
	
	
	public function getClientInfoByEmail($email)
	{
		$action = new Select("users");
		$action->where(array('email = ?' => $email));
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
		 
		if ($result->isQueryResult()){
			$row = $result->current();
			return $row;
		}
		 
		return "";
	}
	
	private function getClientCompteById($id)
	{
		$action = new Select("users");
		$action->where(array('id = ?' => $id));
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
			
		if ($result->isQueryResult()){
			//$row = $result->current();
			
			
			$resultset = new ResultSet();
			$resultset->initialize($result);
			$res = $resultset->toArray();

			return $res[0]['compte'];
			
		}
			
		return 0;
	}
	
	
	
	private function getPrix($poinds, $vip, $depotMode){

	    $action = new Select("prix");
	    $action->where(array('kg = ?' => $poinds));
	    $sql = new Sql($this->dbAdapter);
	    
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    $row = $result->current();
	    
	    // 取出列名
	    $col = '';	    
	    if ($vip == 'v0'){
	    	$col = 'exterieur';
	    }else if ($vip == 'v1'){
	    	if ($depotMode == 'sur_place')
	    	{
	    		$col = 'membre_sur_place';
	    	}else if ($depotMode == 'la_poste'){
	    		$col = 'membre';
	    	}
	    }else if ($vip == 'v2'){
	    	if ($depotMode == 'sur_place')
	    	{
	    		$col = 'vip_sur_place';
	    	}else if ($depotMode == 'la_poste'){
	    		$col = 'vip';
	    	}
	    }
	    
	    return $row[$col];
	}
	

	private function isNewExpAds($data){
		$action = new Select("adresse");
		$action->where(
				array('userId = ?' => $data['id'],
						'nom = ?' => $data['expediteurNom'],
						'adresse = ?' => $data['expediteurAdresse'],
						'ville = ?' => $data['expediteurVille'],
						'codePostale = ?' => $data['expediteurCodePostale'],
						'telephone = ?' => $data['expediteurTelephone'],
				        'expediteur = ?' => 1
				), Predicate\PredicateSet::OP_AND);
		 
		$action->columns(array('num' => new \Zend\Db\Sql\Expression('COUNT(*)')));
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
	
		if ($result->isQueryResult()){
			$res = $result->current();
			if ($res['num'] > 0)
				return false;
			else
				return true;
		}
		return true;
		 
	}
	
	
	private function isNewAds($data){
	    $action = new Select("adresse");
	    $action->where(
	        array('userId = ?' => $data['id'],
    	    'nom = ?' => $data['destinateurNom'],
    	    'adresse = ?' => $data['destinateurAdresse'],
    	    'ville = ?' => $data['destinateurVille'],
    	    'codePostale = ?' => $data['destinateurCodePostale'],
    	     'telephone = ?' => $data['destinateurTelephone'],
	            'expediteur = ?' => 0
    	    ), Predicate\PredicateSet::OP_AND);  
	    
	    $action->columns(array('num' => new \Zend\Db\Sql\Expression('COUNT(*)')));
	    $sql = new Sql($this->dbAdapter);	    
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    	
	    if ($result->isQueryResult()){
	        $res = $result->current();
            if ($res['num'] > 0)
                return false;
            else 
                return true;
	    }
	    return true;
	    
	}
	
	private function saveAdresse($data, $id){
	    
	    $data['id'] = $id;
	    
		if (!$this->isNewAds($data)){
			return;
		}
		$action = new Insert('adresse');
		$action->values(array(
				'nom' => $data['destinateurNom'],
				'adresse' =>  $data['destinateurAdresse'],
				'ville' => $data['destinateurVille'],
		        'pays' => $data['destinateurPay'],
				'telephone' =>  $data['destinateurTelephone'],
				'codePostale' =>  $data['destinateurCodePostale'],
		        'expediteur' => 0,
				'userId' =>  $id
		));
		
		
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
		
		if ($result instanceof ResultInterface )
		{
			return true;
		}else {
			echo "添加新地址失败";
			return false;
		}
	}
	
	
	private function saveExpAdresse($data, $id){
		 
		$data['id'] = $id;
		$data['expediteurPay'] = 'France';
		
		if (!$this->isNewExpAds($data)){
			return;
		}
		
		$action = new Insert('adresse');
		$action->values(array(
				'nom' => $data['expediteurNom'],
				'adresse' =>  $data['expediteurAdresse'],
				'ville' => $data['expediteurVille'],
				'pays' => $data['expediteurPay'],
				'telephone' =>  $data['expediteurTelephone'],
				'codePostale' =>  $data['expediteurCodePostale'],
		        'expediteur' => 1,
				'userId' =>  $id
		));
	
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
	
		$result = $stmt->execute();
		
	
		
		if ($result instanceof ResultInterface )
		{
			return true;
		}else {
			echo "添加发件人新地址失败";
			return false;
		}
	}
	
	private function saveArticles($data, $id) {
	    
	   $articles = $data['articles'];
       if (empty($articles)) {
        return;
       }      
       
       for ($index = 1; $index <= 10; $index++) {
           $des = "descript" . strval($index);
           $quantity = "quantity" . strval($index);
           $poids = "poids" . strval($index);
           $valeur = "valeur" . strval($index);
                                 
           if (!empty($articles[$des]) && $id != "") {
            $row = array();
       		$row['description'] = $articles[$des];
       		$row['quantity'] = $articles[$quantity];
       		$row['poids'] = $articles[$poids];
       		$row['valeur'] = $articles[$valeur];
       		$row['colisId'] = $id;
       		
       		$action = new Insert('articles');
       		$action->values($row);
       		 
       		$sql = new Sql($this->dbAdapter);
       		$stmt = $sql->prepareStatementForSqlObject($action);
       		$result = $stmt->execute();
       	   }
       }
      
      
       if ($result instanceof ResultInterface )
       {
       	return true;
       }else {
        echo "添加详细物品列表失败";     
       	return false;
       }
       
	   
	}
	
	
	public function saveColisArray($dataArray)
	{
        $clientInfo = $this->getClientInfo();	    
	    
        
        if ($clientInfo == ""){
            return "";
        }
        
	    $poindPrevu = $dataArray['poidsPrevu'];
	    $poindPrevu = substr($poindPrevu, 0, -2); // 去掉 'kg'
	    
	    $colisPrix = $this->getPrix($poindPrevu, $dataArray['vip'], $dataArray['depotMode']) ;	    
	    $compte = $this->getClientCompteById($clientInfo['id']);

/*
	    if (($compte - 100) < $colisPrix){
	        return false; 
	    }
*/    
	    
	   $this->saveAdresse($dataArray, $clientInfo['id']);
	   $this->saveExpAdresse($dataArray, $clientInfo['id']);
	   
		$action = new Insert('colis');		
		$action->values(array(
		    'expediteurNom' => $dataArray['expediteurNom'],
		    'expediteurAdresse' => $dataArray['expediteurAdresse'],
		    'expediteurVille' => $dataArray['expediteurVille'],
		    'expediteurCodePostale' => $dataArray['expediteurCodePostale'],
		    'expediteurTelephone'=> $dataArray['expediteurTelephone'],
		    'destinateurNom' => $dataArray['destinateurNom'],
		    'destinateurAdresse' => $dataArray['destinateurAdresse'],
		    'destinateurVille' => $dataArray['destinateurVille'],
		    'destinateurCodePostale' => $dataArray['destinateurCodePostale'],
		    'destinateurPay' => $dataArray['destinateurPay'],
		    'destinateurTelephone' => $dataArray['destinateurTelephone'],
		    'poidsPrevu' => $poindPrevu, //$dataArray['poidsPrevu'],
		    'colisAssurance' => $dataArray['colisAssurance'],
		    'colisGenre' => $dataArray['colisGenre'],
		    'prixPrevu' => $colisPrix,
		    'clientId' => $clientInfo['id']
        ));		

		$sql = new Sql($this->dbAdapter);		
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();

		
		if ($result instanceof ResultInterface)
		{
			if (($newId = $result->getGeneratedValue()) != null)
			{		    
			    $this->saveArticles($dataArray, $newId);
				//$colisObject->setId($newId);
				$dataArray['id'] = $newId;
			}
			return $dataArray;
		}
	
		throw new \Exception("Insert DataArray Database error");
	}

	
	public function udpateRefColis($id, $parcelNum, $pdfUrl, $email)
	{
	    $action = new Update('colis');
	    $action->set(array('refColis'=>$parcelNum, 'pdfUrl'=>$pdfUrl));
	    $action->where(array('id = ?' => $id));
	    
	    
	    $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    
	    if ($result instanceof ResultInterface){
            // 需要添加客户帐户扣邮费
	        
	        $colis = $this->find($id);

	        $prix = $colis->getPrixPrevu() + $colis->getColisAssurance();
	        $solde = $this->getSolde($email);
	        $solde = $solde - $prix;
	        
	        
	        $actionUser = new Update('users');
	        $actionUser->set(array('compte'=>$solde));
	        $actionUser->where(array('email = ?' => $email));
	         
	        $stmtUser = $sql->prepareStatementForSqlObject($actionUser);
	        $resultUser = $stmtUser->execute();
	        
	        if ($resultUser instanceof ResultInterface)
	        {
	        	return $result;
	        }
	        
	         throw new \Exception("修改用户余额失败，请与管理员联系");
	        return $result;
	    }
	    
	    throw new \Exception("Update pdfUrl and refColis Database error");
	}
	
	
	
	
	

	public function saveColis(ColisInterface $colisObject)
	{
		$colisData = $this->hydrator->extract($colisObject);
		unset($colisData['id']);
	
		if ($colisObject->getId()) {
			$action = new Update('colis');
			$action->set($colisData);
			$action->where(array('id = ?' => $colisObject->getId()));
		}else{
			$action = new Insert('colis');
					
			$action->values(array(
			    'expediteurNom' => $colisData['expediteurNom'],
			    'expediteurAdresse' => $colisData['expediteurAdresse'],
			    'expediteurVille' => $colisData['expediteurVille'],
			    'expediteurCodePostale' => $colisData['expediteurCodePostale'],
			    'expediteurTelephone'=> $colisData['expediteurTelephone'],
			    'destinateurNom' => $colisData['destinateurNom'],
			    'destinateurAdresse' => $colisData['destinateurAdresse'],
			    'destinateurVille' => $colisData['destinateurVille'],
			    'destinateurCodePostale' => $colisData['destinateurCodePostale'],
			    'destinateurPay' => $colisData['destinateurPay'],
			    'destinateurTelephone' => $colisData['destinateurTelephone'],
			    'poidsPrevu' => $colisData['poidsPrevu']
//			    'depotTime' => date('Y-m-d H:i:s'),
			
			));
		}
		
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);		
		$result = $stmt->execute();
	
		if ($result instanceof ResultInterface)
		{
			if (($newId = $result->getGeneratedValue()) != null)
			{
				$colisObject->setId($newId);
			}
			return $colisObject;
		}
	
		throw new \Exception("Database error");
	}
	
	
	public function deleteColis(ColisInterface $colis)
	{
		$action = new Delete('colis');
		$action->where(array('id = ?' => $colis->getId()));
		
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
		
		return (bool)$result->getAffectedRows();
	}
	
	
	
	public function calculPrixPrevuByDate($email, $dateDebut, $dateFin)
	{   
	    // Get client info
	    $client =  $this->getClientInfoByEmail($email);
	    
	    $action = new Select("colis");
	    
	    $action->columns(array('prixPrevu' => new \Zend\Db\Sql\Expression('SUM(prixPrevu)')));
	    $action->where(array('clientId = ?' => $client['id'], 'depotTime >= ?' => $dateDebut, 'depotTime <= ?' => $dateFin), Predicate\PredicateSet::OP_AND);
        
        $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	 
	    
		if ($result instanceof ResultInterface && $result->isQueryResult())
    	{
    		 
    		$row = $result->current();
    		if ($row['prixPrevu'] == ""){
    			return 0;
    		}else{
    		  return $row['prixPrevu'];	
    		}
    	}
	    return 0;
	}
	
	public function calculAssuranceByDate($email, $dateDebut, $dateFin)
	{
	    // Get client info
	    $client =  $this->getClientInfoByEmail($email);
	     
	    $action = new Select("colis");
	     
	    $action->columns(array('colisAssurance' => new \Zend\Db\Sql\Expression('SUM(colisAssurance)')));
	    $action->where(array('clientId = ?' => $client['id'], 
	        'depotTime >= ?' => $dateDebut, 
	        'depotTime <= ?' => $dateFin), 
	        Predicate\PredicateSet::OP_AND);
	    
	    $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    
	     
	    if ($result instanceof ResultInterface && $result->isQueryResult())
	    {
	    	$row = $result->current();	 	    	
	    	
	    	if ($row['colisAssurance'] == ""){
	    		return 0;
	    	}else{
	    		return $row['colisAssurance'];
	    	}
	    }
	    
	    return 0;
	}
	
	public function getSolde($email)
	{
	    $client = $this->getClientInfoByEmail($email);
	    return $client['compte'];
		
	}
	
	
	public function findAllPrix()
	{
	    $sql = new Sql($this->dbAdapter);
	    $select = $sql->select('prix');
	    
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	    
	    if ($result instanceof ResultInterface &&
	    $result->isQueryResult() &&
	    $result->getAffectedRows())
	    {
	        $resultset = new ResultSet();
	        $resultset->initialize($result);	        
	        return $resultset->toArray();
	    }
	}
		
	public function findAds($id)
	{
	    $action = new Select('adresse');
	    $action->where(array('userId = ?' => $id));
	    
	    $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    
	    // format result
	    $resultset = new ResultSet();
	    $resultset->initialize($result);
	    return $resultset->toArray();
		
	}
	
	public function findArticles($id)
	{
		$action = new Select('articles');
		$action->where(array('colisId = ?' => $id));
		 
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
		 
		// format result
		$resultset = new ResultSet();
		$resultset->initialize($result);
		return $resultset->toArray();
		
	}
   
}

