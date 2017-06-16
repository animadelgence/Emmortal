<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class mailconfirmation
{
	public $id;
    public $mailCatagory;
    public $mailTemplate;
    public $entryTime;
   
    

    function exchangeArray($data)
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->mailCatagory = (!empty($data['mailCatagory'])) ? $data['mailCatagory'] : null;
		$this->mailTemplate = (!empty($data['mailTemplate'])) ? $data['mailTemplate'] : null;
        $this->entryTime = (!empty($data['entryTime'])) ? $data['entryTime'] : null;
       
        
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
