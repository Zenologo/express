<?php
namespace Login\Mapper;

use Login\Model\UserInterface;

interface UserMapperInterface
{
	/**
	 * @param int/string $id
	 * @return UserInterface
	 * @throws \InvalidArgumentException
	 */
    public function find($id);
    
    public function findUserByEmail($email);
    
    /**
     * @return array/UserInterface
     */
    public function findAll();

	/**
	*	@param UserInterface $userObject
	* @param UserInterface $userObject
	* @return UserInterface
	* @throws \Exception
	*/
	public function save($data);    
		
    public function delete(UserInterface $userObject);

    public function isDuplicateEmail($email);
    
    public function isAdmin($email);
    
    public function findAllAds($id);
    
    public function addAdresse($post);
    
    public function deleteAdresse($colisId, $userId);
		
    public function updateUserInfo($data);
    
    public function findAllExpAds($id);
    
    public function addExpAdresse($post);
}
