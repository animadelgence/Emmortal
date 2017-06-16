<?php
namespace Profile\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class pagedetails
{
	public $pageid;
    public $UID;
    public $createddate;
    function exchangeArray($data)
	{
		$this->pageid = (!empty($data['pageid'])) ? $data['pageid'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->createddate = (!empty($data['createddate'])) ? $data['createddate'] : null;
    }

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
