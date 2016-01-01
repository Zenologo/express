<?php
namespace Login\Mapper;

use Login\Model\UserInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\sql\Insert;
use Zend\Db\sql\Select;
use Zend\Db\sql\Delete;
use Zend\Db\sql\Update;
use Zend\Session\Container;
use Zend\Db\Sql\Predicate;
use Zend\Db\ResultSet\ResultSet;


class ZendDbSqlMapper implements UserMapperInterface
{
	protected $dbAdapter;
	protected $hydrator;
	protected $userPrototype;
	
	
	public function __construct(AdapterInterface $dbAdapter, HydratorInterface $hydrator, UserInterface $userPrototype)
	{

		$this->dbAdapter = $dbAdapter;
		$this->hydrator = $hydrator;
		$this->userPrototype = $userPrototype;
	}
	
	public function find($id)
	{
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('users');
		$select->where(array('id=?' => $id));

		
		
		$stmt = $sql->prepareStatementForSqlObject($select);	
        $result = $stmt->execute();
		
		if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows())
		{		    
			return $this->hydrator->hydrate($result->current(), $this->userPrototype);
		}
		
		throw new \InvalidArgumentException("用户ID: {$id} 不存在");
	}
	
	public function findUserByEmail($email)
	{
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('users');
		$select->where(array('email = ?' => $email));
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
		
		if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows())
		{
		    $this->hydrator->hydrate($result->current(), $this->userPrototype);
			return $this->hydrator->extract($this->userPrototype); 
		}
		
		throw new \InvalidArgumentException(" 用户邮箱: {$email} 不存在");
		
	}
	
	public function findAll()
	{	    
	    
	    
	    $sql = new Sql($this->dbAdapter);
	    $select = $sql->select('users');
	     
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	    
	    if ($result instanceof  ResultInterface && $result->isQueryResult()) 
	    {
	        $resultSet = new HydratingResultSet($this->hydrator, $this->userPrototype);
	   		return $resultSet->initialize($result);
		}
	    return array();
	}

	
	public function isAdmin($email)
	{
	    $sql = new Sql($this->dbAdapter);
	    $select = $sql->select('users');
	    
	    $select->where(array('email=?' => $email, 'admin > 0'),  Predicate\PredicateSet::OP_AND);
	    
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	    	    
	    if ($result instanceof ResultInterface && $result->isQueryResult())
	    {
	        $user = $result->current();
	        return $user['admin'];
	    }
	    
	    return 0;
	}
	
	
	public function isDuplicateEmail($email)
	{	    
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('users');
		
		$select->where(array('email=?' => $email));		
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();
/*		
		echo "true : " . true . "<p>";
		echo "isQueryResult : ". $result->isQueryResult() . "<p>";
		echo "instanceof " . $result instanceof  ResultInterface . "<p>";
	    echo "count: " . $result->count() . "<p>";
*/
		
		if ($result instanceof ResultInterface && 
		      $result->count() == 0)
		{
			return false;
		}
		    
	    return true;
	}

	
	private function isDuplicateRefClient($ref)
	{
	    $sql = new Sql($this->dbAdapter);
	    $select = $sql->select('users');
	    
	    $select->where(array('ref=?' => $ref));
	    
	    $stmt = $sql->prepareStatementForSqlObject($select);
	    $result = $stmt->execute();
	    /*
	     echo "true : " . true . "<p>";
	    echo "isQueryResult : ". $result->isQueryResult() . "<p>";
	    echo "instanceof " . $result instanceof  ResultInterface . "<p>";
	    echo "count: " . $result->count() . "<p>";
	    */
	    
	    if ($result instanceof ResultInterface && $result->count() == 0)
	    {
	    	return false;
	    }
	    
	    return true;
	    
	    
	}
	
	
	private function generateRefClient()
	{
		$ref = "ST";
	    $num = rand(1000, 99999);
	    $num = sprintf("%05d", $num);
	    $ref = $ref . $num;
	    return $ref;
	}
	
	
	
	public function save($data)
	{	
		$refClient = $this->generateRefClient();
				 		
        while ($this->isDuplicateRefClient($refClient))
		{
		    $refClient = $this->generateRefClient();
		}
		
		$action = new Insert('users');
		$action->values(array(
		    'ref' => $refClient, 
		    'nom' =>  $data['nom'],
		    'adresse' =>  $data['adresse'], 
		    'telephone' =>  $data['telephone'],
		    'pay' => $data['pay'], 
		    'email' =>  $data['email'],
		    'pwd' =>  $data['pwd']
		));
		

		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		
		$result = $stmt->execute();


		echo " inserted membre <p>";
		
		
		if ($result instanceof ResultInterface)
		{
		    /*
			if ($newId = $result->getGeneratedValue())
			{
				$userObject->setId($newId);
			}
			*/
			

			$session = new Container("User");
			$session->offsetSet('email', $data['email']);
			$session->offsetSet('nom', $data['nom']);
			$session->offsetSet('admin', '0');
			$session->offsetSet('vip', '0');
				
			
			return $data;

		}
		throw new \Exception("Database error");
	}	
	

    public function delete(UserInterface $userObject)
    {
    	$action = new Delete('users');
    	$action->where(array('id = ?' => $userObject->getId()));
    	
    	$sql = new Sql($this->dbAdapter);
    	$stmt = $sql->prepareStatementForSqlObject($action);
    	$result = $stmt->execute();
    	return (bool)$result->getAffectedRows();
    }
    
 
    public function findAllAds($id)
    {
        $action = new Select('adresse');
        $action->where(array('userId = ?' => $id, 'expediteur = ?' => 0), Predicate\PredicateSet::OP_AND);

        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        // format result
        $resultset = new ResultSet();
        $resultset->initialize($result);
        return $resultset->toArray();
    }
    
    
    public function addAdresse($post)
    {      
        
       
        $action = new Insert('adresse');
        $action->values(array(
        		'nom' => $post['destinateur_nom'],
        		'adresse' =>  $post['destinateur_ads'],
                'ville' => $post['destinateur_ville'],
        		'telephone' =>  $post['destinateur_telephone'],
        		'codePostale' =>  $post['destinateur_zip'],
                'pays' => $post['destinateur_pays'],
        		'userId' =>  $post['userId']
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
    
    public function deleteAdresse($colisId, $userId)
    {
        $action = new Delete('adresse');
        $action->where(array('id = ?' => $colisId, 'userId' => $userId), Predicate\PredicateSet::OP_AND);
         
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();
        return (bool)$result->getAffectedRows();
    	
    }
    
    
    public function updateUserInfo($data) {
        $id = $data['id'];
                
        $action = new Update('users');
        $action->set(array(
        		'telephone' =>  $data['telephone'],
        		'pwd' =>  $data['password']
        ));
        $action->where(array('id = ?' => $data['id'] ));
        
        
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
    }
    
    public function findAllExpAds($id){
        $action = new Select('adresse');
        $action->where(array('userId = ?' => $id, 'expediteur = ?' => 1), Predicate\PredicateSet::OP_AND);
        
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface )
        {
  	        // format result
            $resultset = new ResultSet();
            $resultset->initialize($result);
            return $resultset->toArray();
        }else {

        	return array();
        }
    }
    
    public function addExpAdresse($post){
        
        $action = new Insert('adresse');
        $action->values(array(
        		'nom' => $post['expediteur_nom'],
        		'adresse' =>  $post['expediteur_ads'],
        		'ville' => $post['expediteur_ville'],
        		'telephone' =>  $post['expediteur_telephone'],
        		'codePostale' =>  $post['expediteur_zip'],
        		'pays' => $post['expediteur_pays'],
        		'userId' =>  $post['userId'],
                'expediteur' => $post['expediteur']
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
    
}
