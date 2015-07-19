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
	public function save(UserInterface $userObject);    
		
    public function delete(UserInterface $userObject);

    public function isDuplicateEmail(UserInterface $user);
		
}
