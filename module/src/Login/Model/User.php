<?php
namespace Login\Model;

class User implements UserInterface
{
    /**
     * 
     * @var int
     */
    protected $id;
    
    
    /**
     * 
     * @var string
     */
    protected $nom;
    
    /**
     * 
     * @var string
     */
    protected $prenom;
    
    /**
     * 
     * @var string
     */
    protected $telephone;
    
    /**
     * 
     * @var string
     */
    protected $email;
    
    
	/** (non-PHPdoc)
	 * @see \Login\Model\UserInterface::getId()
	 */
	public function getId() {
		// TODO Auto-generated method stub
		return $this->id;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	
	/** 
	 * {@inheritDoc}
	 * @see \Login\Model\UserInterface::getNom()
	 */
	public function getNom() {
        return $this->nom;
	}
	
	/**
	 * @param string $nom
	 */
	public function setNom($nom) {
		$this->nom = $nom;
	}

	/**
	 * @param string $prenom
	 */
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}

	/**
	 *{@inheritDoc} 
	 * @see \Login\Model\UserInterface::getPrenom()
	 */
	public function getPrenom() {
		return $this->prenom;
	}

	/**
	 * {@inheritDoc}
	 * @see \Login\Model\UserInterface::getTelephone()
	 */
	public function getTelephone() 
	{
	   return $this->telephone;
	}
	
	/**
	 * @param string $telephone
	 */
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}

	/** 
	 * {@inheritDoc}
	 * @see \Login\Model\UserInterface::getEmail()
	 */
	public function getEmail() 
	{
	   return $this->email;
	}
	
	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}


    
}