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
    protected $telephone;
    
    /**
     * 
     * @var string
     */
    protected $email;
    
    
    protected  $pay;
    
    protected $pwd;
    
    protected $adresse;
    
    protected $admin;
    
    protected  $vip;
    
    
    


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
	public function setEmail($email) 
	{
		$this->email = $email;
	}


	public function getPay()
	{
		return $this->pay;	    
	}
	
	public function setPay($pay)
	{
		$this->pay = $pay;
	}
    
	public function getAdresse()
	{
		return $this->adresse;
	}
	
	public function setAdresse($adresse)
	{
		$this->adresse = $adresse;
	}
	
	public function getPwd()
	{
		return $this->pwd;
	}
	
	public function setPwd($pwd)
	{
		$this->pwd = $pwd;
	}
	

	/**
	 * @return the $admin
	 */
	public function getAdmin() {
		return $this->admin;
	}
	
	/**
	 * @param field_type $admin
	 */
	public function setAdmin($admin) {
		$this->admin = $admin;
	}
	/**
	 * @return the $vip
	 */
	public function getVip() {
		return $this->vip;
	}

	/**
	 * @param field_type $vip
	 */
	public function setVip($vip) {
		$this->vip = $vip;
	}

	
	
	
	
}