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
    
    public function isDuplicateEmail(UserInterface $user)
    {
    	return $this->userMapper->isDuplicateEmail($user);
    }
    
	public function saveUser(UserInterface $user)
	{
		return $this->userMapper->save($user);
	} 
	
	public function deleteUser(UserInterface $user)
	{
		return $this->userMapper->delete($user);
	}
}
