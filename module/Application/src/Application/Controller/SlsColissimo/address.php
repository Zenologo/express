<?php
namespace Application\Controller\SlsColissimo;


class address{

    
    /**
     * 
     * @var string
     */
    protected $lastName;
    
    /**
     * @string
     */
    protected $firstName;
    
    /**
     * @string
     */
    protected $line0;
    
    /**
     * @string
     */
    protected $line1;
    
    
    /**
     * @string
     */
    protected $line2;
    
    /**
     * @string
     */
    protected $line3;
    
    
    /**
     * @string
     */
    protected $countryCode;
    
    /**
     * @string
     */
    protected $city;
    
    /**
     * @string
     */
    protected $zipCode;
    
        
    /**
     * @string
     */
    protected $mobileNumber;
    

    protected $phoneNumber;
    
    
    
    protected $email;
    
    
    
    
    
    
    
    
    
    

	/**
	 * @return the $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param field_type $firstName
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @param field_type $email
	 */
	public function setEmail($email) {
		$this->email = "yanleifrance@yahoo.fr"; //$email;
	}

	/**
	 * @return the $phoneNumber
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * @param field_type $phoneNumber
	 */
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}

	/**
	 * @return the $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @return the $firstName
	 */
/* 	public function getFirstName() {
		return $this->firstName;
	}
 */

	/**
	 * @return the $countryCode
	 */
	public function getCountryCode() {
		return $this->countryCode;
	}

	/**
	 * @return the $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @return the $zipCode
	 */
	public function getZipCode() {
		return $this->zipCode;
	}

	/**
	 * @return the $mobileNumber
	 */
	public function getMobileNumber() {
		return $this->mobileNumber;
	}


	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * @param field_type $firstName
	 */
//	public function setFirstName($firstName) {
//		$this->firstName = $firstName;
//	}

	
	
	
	
	/**
	 * @return the $line0
	 */
	public function getLine0() {
		return $this->line0;
	}
	
	/**
	 * @return the $line1
	 */
	public function getLine1() {
		return $this->line1;
	}

	/**
	 * @return the $line2
	 */
	public function getLine2() {
		return $this->line2;
	}

	/**
	 * @return the $line3
	 */
	public function getLine3() {
		return $this->line3;
	}

	/**
	 * @param field_type $line0
	 */
	public function setLine0($line0) {
		$this->line0 = $line0;
	}
	
	/**
	 * @param field_type $line1
	 */
	public function setLine1($line1) {
		$this->line1 = $line1;
	}

	/**
	 * @param field_type $line2
	 */
	public function setLine2($line2) {
		$this->line2 = $line2;
	}

	/**
	 * @param field_type $line3
	 */
	public function setLine3($line3) {
		$this->line3 = $line3;
	}

	/**
	 * @param field_type $countryCode
	 */
	public function setCountryCode($countryCode) {
		$this->countryCode = $countryCode;
	}

	/**
	 * @param field_type $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @param field_type $zipCode
	 */
	public function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
	}

	/**
	 * @param field_type $mobileNumber
	 */
	public function setMobileNumber($mobileNumber) {
		$this->mobileNumber = $mobileNumber;
	}

	/**
	 * Getter
	 *
	 * @param string $name
	 */
	public function __get($name)
	{
		$method = 'get' . ucfirst($name);
		if (method_exists($this, $method)) {
			return $this->$method();
		}
	}
    
    
    
}