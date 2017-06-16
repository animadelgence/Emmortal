<?php
namespace Authorization\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class trackdetails
{
	public $ip;
    public $trackserverdetails;
    public $trackdate;

    function exchangeArray($data)
	{
		$this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
		$this->trackserverdetails = (!empty($data['trackserverdetails'])) ? $data['trackserverdetails'] : null;
		$this->trackdate = (!empty($data['trackdate'])) ? $data['trackdate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
