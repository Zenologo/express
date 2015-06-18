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
  }


}
