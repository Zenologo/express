<?php
namespace Admin\Model;

interface UserInterface
{

    
	/** (non-PHPdoc)
	 * @see \Login\Model\UserInterface::getId()
	 */
	public function getId();

	public function getNom();

	
	public function getTelephone(); 

	public function getEmail(); 


	public function getPay();
	
	public function getAdresse();
	
	public function getPwd();
	
	public function getCompte();
	
	public function getRef();	
	
	public function getVip();
	
	public function getAdmin();
	
	
}