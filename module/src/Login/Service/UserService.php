<?php
namespace Login\Service;

use Login\Model\user;

class UserService implements UserServiceInterface
{
    protected $data = array(
        array(
    	   'id' => 1,
            'nom' => 'YAN1',
            'prenom' => 'Lei1',
            'telephone' => '0123456789',
            'email' => 'yanlei01@yahoo.fr',
        ),	
        array(
    		'id' => 2,
    		'nom' => 'YAN2',
    		'prenom' => 'Lei2',
    		'telephone' => '0123456789',
    		'email' => 'yanlei02@yahoo.fr',
        ),        
        array(
    		'id' => 3,
    		'nom' => 'YAN3',
    		'prenom' => 'Lei3',
    		'telephone' => '0123456789',
    		'email' => 'yanlei03@yahoo.fr',
        ),
        array(
    		'id' => 4,
    		'nom' => 'YAN4',
    		'prenom' => 'Lei4',
    		'telephone' => '0123456789',
    		'email' => 'yanlei04@yahoo.fr',
        ),
        array(
    		'id' => 5,
    		'nom' => 'YAN5',
    		'prenom' => 'Lei5',
    		'telephone' => '0123456789',
    		'email' => 'yanlei05@yahoo.fr',
        )
    );
    
    
	/**
	 * (@inheritDoc)
	 * @see \Login\Service\UserServiceInterface::findAllUser()
	 */
    public function findAllUser()
    {
    	$allUser = array();
    	foreach ($this->data as $index => $user)
    	{
    		$allUser[] = $this->findUser($user);
    	}
        return $allUser;
    }
    
    /**
     * (@inheritDoc)
     * @see \Login\Service\UserServiceInterface::findUser()
     */
    public function findUser($id)
    {
        $userData = $this->data[$id];
        
        $model = new User();
        $model->setId($userData['id']);
        $model->setNom($userData['nom']);
        $model->setPrenom($userData['prenom']);
        $model->setEmail($userData['email']);
        $model->setTelephone($userData['telephone']);
    }
    
    
}