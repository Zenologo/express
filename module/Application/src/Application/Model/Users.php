<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFileAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Users implements InputFilterInterface
{
    public $id;
    public $nom;
    public $prenom;
    public $adresse;
    public $telephone;
    public $email;
    public $pwd;
    public $pay;
    
    protected $inputFilter;
    
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nom = (isset($data['nom'])) ? $data['nom'] : null;
        $this->prenom = (isset($data['prenom'])) ? $data['prenom'] : null;
        $this->adresse = (isset($data['adresse'])) ? $data['adresse'] : null;
        $this->telephone = (isset($data['telephone'])) ? $data['telephone'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->pay = (isset($data['pay'])) ? $data['pay'] : null;
        $this->pwd = (isset($data['pwd'])) ? $data['pwd'] : null;
    }
    
    public function setInputFilter(InputFilterInterface $){
        throw new \Dxception("Not used");
    }
    
    public function getInputFilter(){
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add( array(
                'name'      => 'id',
                'required'  => true,
                'filters'   => array(
                    array('name' => 'int'),
                    ),
                )
            );
            
            $input->add( array(
                'name'      => 'nom',
                'required'  => true,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 1,
                            'max'       => 50,
                            ),
                    ),
                ),
            ));
            
            
             $input->add( array(
                'name'      => 'prenom',
                'required'  => true,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 1,
                            'max'       => 50,
                            ),
                    ),
                ),
            ));
            
             $input->add( array(
                'name'      => 'addresse',
                'required'  => false,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 50,
                            ),
                    ),
                ),
            ));
            
            
             $input->add( array(
                'name'      => 'telephone',
                'required'  => true,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 10,
                            'max'       => 20,
                            ),
                    ),
                ),
            ));
            
            
             $input->add( array(
                'name'      => 'email',
                'required'  => true,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 5,
                            'max'       => 50,
                            ),
                    ),
                ),
            ));
            
            
            
             $input->add( array(
                'name'      => 'pay',
                'required'  => false,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 3,
                            'max'       => 256,
                            ),
                    ),
                ),
            ));
            
             $input->add( array(
                'name'      => 'pwd',
                'required'  => true,
                'filters'   => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                ),
                'validators'    => array(
                    array(
                        'name'          => 'StringLength',
                        'options'       => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 6,
                            'max'       => 50,
                            ),
                    ),
                ),
            ));
            
            $this->inputFilter = $inputFilter;
        }    
        return $this->inputFilter;
        
    }
    
    
}
