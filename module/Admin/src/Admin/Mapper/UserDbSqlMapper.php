<?php
namespace Admin\Mapper;

use Admin\Model\UserInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\sql\Insert;
use Zend\Db\sql\Update;
use Zend\Db\sql\Delete;
use Zend\Session\Container;

class UserDbSqlMapper implements UserMapperInterface
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
		
		throw new \InvalidArgumentException("User with given ID:{$id} not found");


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

	
	
	public function isDuplicateEmail(UserInterface $user)
	{	    
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select('users');
		
		$select->where(array('email=?' => $user->getEmail()));		
		
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();

		
		if ($result instanceof ResultInterface && 
		      $result->count() == 0)
		{
			return false;
		}
		    
	    return true;
	}
	

	/**
   * @param UserInterface $userObject
	 * @return UserInterface
	 * @throws \Exception
	 *
	 */
	public function save(UserInterface $userObject)
	{	    
		$userData = $this->hydrator->extract($userObject); 
		unset($userData['id']); // Neither insert nor update needs the ID in the array
		unset($userData['admin']);

		
		if ($userObject->getId())
		{
			// ID present, it's an update
			$action = new Update('users');
			$action->set($userData);
			$action->where(array('id = ?' => $userObject->getId() ));
			
		} else {
			// ID NOT present, it's an insert
			$action = new Insert('users');
			$action->values($userData);
		}
		
		
		
		
		
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		
		
		
		
		
        $result = $stmt->execute();
		
		
	//	die();
		
		if ($result instanceof ResultInterface)
		{
		    
			if ($newId = $result->getGeneratedValue())
			{
				// When a value has been generated, set it on the object
				$userObject->setId($newId);
			}
			
/* 			
            $session = new Container("User");
			$session->offsetSet('email', $userObject->getemail());
			$session->offsetSet('nom', $userObject->getNom());
			$session->offsetSet('member', 'yes');
			$session->offsetSet('vip', $userObject->getVip());
*/
			
			return $userObject;

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
    
    
    
    public function consommerTotal($refClient, $solde)
    {
        $action = new Update('users');
		$action->set(array('compte'=>$solde));
		$action->where(array('ref = ?' => $refClient));
		
		$sql = new Sql($this->dbAdapter);
		$stmt = $sql->prepareStatementForSqlObject($action);
		$result = $stmt->execute();
		 
		
		if ($result instanceof ResultInterface)
		{
			return true;
		}else{
			echo "数据库出错，不能更新客户余额. 客户代码" . $refClient . ", 应有余额: ". $solde . "<p>";
			return false;
		}
    }
    
    
    
    public function resetPWD($userId)
    {
        $action = new Update('users');
        $action->set(array('pwd'=>'123'));
        $action->where(array('id = ?' => $userId));        
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface)
        {
        	return true;
        }else{
        	echo "数据库出错，不能更新客户余额. 客户代码" . $userId  . "<p>";
        	return false;
        }
        
    }
}
