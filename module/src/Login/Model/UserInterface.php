<?php
namespace Login\Model;

interface UserInterface
{
    /**
     * Will return user's ID
     * @return int
     */
	public function getId();
	
	/**
	 * Will return user's seconde name
	 */
	public function getNom();
	
	/**
	 * Will return user's first name
	 */
	public function getPrenom();
	
	/**
	 * Will return user's email.
	 */
	public function getEmail();
	
	/**
	 * Will return user's telephone
	 */
	public function getTelephone();
}