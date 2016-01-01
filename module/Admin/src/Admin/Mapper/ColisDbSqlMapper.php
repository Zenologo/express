<?php
namespace Admin\Mapper;

use Admin\Model\ColisInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Predicate;


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
	
	
	public function find($id)
	{
		$sql = new Sql($this->dbAdapter);
			
		/* 
        $stmt = $this->dbAdapter->createStatement('SELECT * FROM colis, users WHERE colis.clientId = users.id AND colis.id =' . $id);
		$stmt->prepare();
        $result = $stmt->execute();
        $resultSet = new ResultSet;
        $resultSet->initialize($result);
        print_r($resultSet->toArray() );
        */
        
        
		$select = $sql->select()
		              ->from(array('c' => 'colis'))->where(array('c.id=?'=>$id))
		              ->join(array('u' => 'users'), 'u.id = c.clientId', array('ref', 'nom', 'telephone', 'compte'));
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		
		//$resultset = new ResultSet();
		//$resultset->initialize($result);
		//print_r($resultset->toArray());
		
		if ($result instanceof ResultInterface && $result->isQueryResult() && 1 == $result->count())
		{
		    $resultset = new ResultSet();
		    $resultset->initialize($result);
			return $resultset->toArray();
		}
		
		throw new \InvalidArgumentException("Colis with given ID:($id) is not valide");
	}
	
	public function findAll()
	{   
		$sql = new Sql($this->dbAdapter);
		//$select = $sql->select('colis');

		$select = $sql->select()
		              ->from(array('u' => 'users'), array('id', 'ref', 'nom', 'compte'))
		              ->join(array('c' => 'colis'), 'u.id = c.clientId');
		
		
		
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		
		
		
		if ($result instanceof ResultInterface && $result->isQueryResult())
		{            
		    		    
			$resultSet = new HydratingResultSet($this->hydrator, $this->colisPrototype);
			
			
//			$rs = $resultSet->initialize($result);
			
			
		/* 	echo "<p> count is " . $rs->count() . " find all <p>";
			
			$s = $rs->current();
			
           
			
            echo "<p> id: " . $s->getId() . "<p>";
            echo "<p> expediteur nom " . $s->getExpediteurNom() . "<p>";                                
            
			$ar = array('tt' => $rs);
            
            
			$i = 0;
			foreach ($ar as $r):
			   echo "this is : " . $i ; 
			   $i++;			   
			endforeach;
			
			
			echo "<p> count is " . $rs->count() . " end <p>";
			
			 */
			
					
			
			return $result; // $resultSet->initialize($result);
		}	
		
		echo "Database is empty";
		
		return array();		
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
			$action->values('colisData');
		}
	
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
	
		if ($result instanceof ResultInterface)
		{
			if ($newId = $result->getGenerateValue())
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
	
	
	public function findColisByDate($dateDebut, $dateFin)
	{   
	       
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select()
                    ->from(array('u' => 'users'), array('id', 'ref', 'nom'))
                    ->join(array('c' => 'colis'), 'u.id = c.clientId')
                   ->where(array('depotTime >= ?' => $dateDebut, 'depotTime <= ?' => $dateFin), Predicate\PredicateSet::OP_AND);
                     
        
        
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	 
	    
	    if ($result instanceof ResultInterface && $result->isQueryResult())
	    {   
	    	return $result;
	    }
	    
		
	}
	
	public function calculPrixPrevuByDate($dateDebut, $dateFin)
	{
		$action = new Select("colis");
		$action->columns(array('prixPrevu' => new \Zend\Db\Sql\Expression('SUM(prixPrevu)')));
		$action->where(array('depotTime >= ?' => $dateDebut, 'depotTime <= ?' => $dateFin), Predicate\PredicateSet::OP_AND);
	    
        $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	 
	    
	    if ($result instanceof ResultInterface && $result->isQueryResult())
	    {
	        
	        $row = $result->current();
	    	return $row['prixPrevu'];
	    }
	}
	
	public function calculAssuranceByDate($dateDebut, $dateFin)
	{
		$action = new Select("colis");
		$action->columns(array('colisAssurance' => new \Zend\Db\Sql\Expression('SUM(colisAssurance)')));
        $action->where(array('depotTime >= ?' => $dateDebut, 'depotTime <= ?' => $dateFin), Predicate\PredicateSet::OP_AND);
	    $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	 
	    
	    if ($result instanceof ResultInterface && $result->isQueryResult())
	    {
	        $row = $result->current();
	        return $row['colisAssurance'];
	    }
	}
	
	public function findAllCommande()
	{
	    $sql = new Sql($this->dbAdapter);
	    
	    $select = $sql->select()
	    ->from(array('u' => 'users'), array('id', 'ref', 'nom', 'compte'))
	    ->join(array('c' => 'colis'), 'u.id = c.clientId')
	    ->where(array('c.state = ?' => '下单'));
	    
	    
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	    
	    if ($result instanceof ResultInterface && $result->isQueryResult())
	    {
	    	return $result; 
	    }
	    
	    return array();
	}
   
	public function saveColisRef($id, $refColis)
	{
	    
	   
	    $action = new Update('colis');
	    $action->set(array('refColis'=>$refColis, 'state'=>'已出单'));
	    $action->where(array('id = ?' => $id));
	    
	    $sql = new Sql($this->dbAdapter);
	    $stmt = $sql->prepareStatementForSqlObject($action);
	    $result = $stmt->execute();
	    

	    if ($result instanceof ResultInterface)
	    {
	    	return true;
	    }else{
	    	echo "数据库出错，不能更新包裹： " . $id . ", 包裹号: ". $refColis . "<p>";
	        return false;
	    }
	    
	    
	    
	}
	
	
}

