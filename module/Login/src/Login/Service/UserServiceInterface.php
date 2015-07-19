<?php
namespace Login\Service;

use Login\Model\UserInterface;

interface UserServiceInterface
{
    /**
     * Should return a set of all users that we can iterate over.
     */
	public function findAllUser();
	
	public function findUser($id);
    
	public function saveUser(UserInterface $user);   

	public function deleteUser(UserInterface $user);
	
	public function isDuplicateEmail(UserInterface $user);
}
