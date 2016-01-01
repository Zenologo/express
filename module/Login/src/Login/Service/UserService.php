<?php
namespace Login\Service;

use Login\Mapper\UserMapperInterface;
use Login\Model\UserInterface;


class UserService implements UserServiceInterface
{
    
    
    protected $userMapper;
    
    public function __construct(UserMapperInterface $userMapper)
    {
    	$this->userMapper = $userMapper;   
    }
    
    
    
	/**
	 * (@inheritDoc)
	 * @see \Login\Service\UserServiceInterface::findAllUser()
	 */
    public function findAllUser()
    {
        echo "UserService, line: " . __LINE__ . "<p>";
        return $this->userMapper->findAll();
    }
    
    /**
     * (@inheritDoc)
     * @see \Login\Service\UserServiceInterface::findUser()
     */
    public function findUser($id)
    {   
        $result = $this->userMapper->find($id);
        return  $result;
    }
    
    public function findUserByEmail($email)
    {
    	return $this->userMapper->findUserByEmail($email);
    }
    
    
    public function isAdmin($email)
    {
    	return $this->userMapper->isAdmin($email);   
    }
    
    public function isDuplicateEmail($email)
    {
    	return $this->userMapper->isDuplicateEmail($email);
    }
    
	public function saveUser($data)
	{
		return $this->userMapper->save($data);
	} 
	
	public function deleteUser(UserInterface $user)
	{
		return $this->userMapper->delete($user);
	}
	
	public function findAllAds($id)
	{
		return $this->userMapper->findAllAds($id);
	}
	
	public function addAdresse($post)
	{
		return $this->userMapper->addAdresse($post);
	}
	
	public function deleteAdresse($colisId, $userId)
	{
		return $this->userMapper->deleteAdresse($colisId, $userId);
	}
	
	public function updateUserInfo($data){
	   return $this->userMapper->updateUserInfo($data);	
	}
	
	public function findAllExpAds($id){
		return $this->userMapper->findAllExpAds($id);
	}
	
	public function addExpAdresse($post){
		return $this->userMapper->addExpAdresse($post);
	}
	
}
