<?php
namespace Authorization\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class trackdetailsafterlogin
{
	public $UID;
    public $trackpage;
    public $trackserverdetails;
    public $trackdate;

    function exchangeArray($data)
	{
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->trackpage = (!empty($data['trackpage'])) ? $data['trackpage'] : null;
		$this->trackserverdetails = (!empty($data['trackserverdetails'])) ? $data['trackserverdetails'] : null;
		$this->trackdate = (!empty($data['trackdate'])) ? $data['trackdate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
