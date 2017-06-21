<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class tributedetails
{
	public $tributesid;
    public $UID;
    public $description ;
    public $friendsid;
    public $addeddate;

    function exchangeArray($data)
	{
		$this->tributesid = (!empty($data['tributesid'])) ? $data['tributesid'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->description     = (!empty($data['description   '])) ? $data['description   '] : null;
        $this->friendsid   = (!empty($data['friendsid'])) ? $data['friendsid'] : null;
        $this->addeddate    = (!empty($data['addeddate'])) ? $data['addeddate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
