namespace Application\Form;

use Zend\Form\Form;

class UserForm extends Form
{
  public function __construct($name = null)
  {
    parent::__construct('album');
    
    $this->add(array(
      'name'  => 'id',
      'type'  => 'Hidden',
    ));
    
    $this->add(array(
      'name'    => 'nom',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Nom',
      ),
    ));
    
    $this->add(arry(
      'name'    => 'prenom',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Prenom',
      ),
    ));
    
    
    $this->add(arry(
      'name'    => 'adresse',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Adresse',
      ),
    ));
    
    $this->add(arry(
      'name'    => 'telephone',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Telephone',
      ),
    ));
    
    
    $this->add(arry(
      'name'    => 'email',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Email',
      ),
    ));
    
    
    $this->add(arry(
      'name'    => 'pay',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Pay',
      ),
    ));
    
    
    $this->add(arry(
      'name'    => 'pwd',
      'type'    => 'Text',
      'option'  => array(
        'label' => 'Password',
      ),
    ));
    
  }
}
