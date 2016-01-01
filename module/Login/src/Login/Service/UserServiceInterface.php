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
	
	public function findUserByEmail($email);
    
	public function saveUser($data);   

	public function deleteUser(UserInterface $user);
	
	public function isDuplicateEmail($email);
	
	public function isAdmin($email);
	
    public function findAllAds($id);	
    
    public function addAdresse($post);
    
    public function deleteAdresse($colisId, $userId);
    
    public function updateUserInfo($data);
    
    public function findAllExpAds($id);
    
    public function addExpAdresse($post);
}
