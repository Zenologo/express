<?php
namespace Admin\Service;

use Admin\Model\UserInterface;

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
	
	public function consommerTotal($refClient, $solde);
	
	public function resetPWD($userId);
}
