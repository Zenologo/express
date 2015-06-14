<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFileAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Users
{
    public $id;
    public $nom;
    public $prenom;
    public $adresse;
    public $telephone;
    public $email;
    public $pwd;
    public $pay;
    
    
    public function exchangeArray($data)
    {
    	
        
    }
    
    
    
    
}