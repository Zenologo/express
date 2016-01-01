<?php
namespace Admin\Model;


class User implements UserInterface
{
    
    /**
     * 
     * @var number
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
    
    /**
     * 
     * @var string
     */
    protected $pay;
    
    /**
     * 
     * @var string
     */
    protected $pwd;
    
    /**
     * 
     * @var string
     */
    protected $adresse;
    
    /**
     * 
     * @var number
     */
    protected $compte;
    
    /**
     * 
     * @var string
     */
    protected $ref;
    
    /**
     * @var number
     */
    protected $vip;
    
    /**
     * @var integer
     */
    protected $admin;
    
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nom
	 */
	public function getNom() {
		return $this->nom;
	}



	/**
	 * @return the $telephone
	 */
	public function getTelephone() {
		return $this->telephone;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $pay
	 */
	public function getPay() {
		return $this->pay;
	}

	/**
	 * @return the $pwd
	 */
	public function getPwd() {
		return $this->pwd;
	}

	/**
	 * @return the $adresse
	 */
	public function getAdresse() {
		return $this->adresse;
	}

	/**
	 * @return the $compte
	 */
	public function getCompte() {
		return $this->compte;
	}

	/**
	 * @return the $ref
	 */
	public function getRef() {
		return $this->ref;
	}

	/**
	 * @return the $vip
	 */
	public function getVip() {
		return $this->vip;
	}

	/**
	 * @return the $admin
	 */
	public function getAdmin() {
		return $this->admin;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $nom
	 */
	public function setNom($nom) {
		$this->nom = $nom;
	}

	/**
	 * @param string $telephone
	 */
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param string $pay
	 */
	public function setPay($pay) {
		$this->pay = $pay;
	}

	/**
	 * @param string $pwd
	 */
	public function setPwd($pwd) {
		$this->pwd = $pwd;
	}

	/**
	 * @param string $adresse
	 */
	public function setAdresse($adresse) {
		$this->adresse = $adresse;
	}

	/**
	 * @param number $compte
	 */
	public function setCompte($compte) {
		$this->compte = $compte;
	}

	/**
	 * @param string $ref
	 */
	public function setRef($ref) {
		$this->ref = $ref;
	}

	/**
	 * @param number $vip
	 */
	public function setVip($vip) {
		$this->vip = $vip;
	}

	/**
	 * @param integer $admin
	 */
	public function setAdmin($admin) {
		$this->admin = $admin;
	}

	
}