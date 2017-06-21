<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class likesdetails
{
	public $likeid;
    public $UID;
    public $AID;
    public $uploadId;
    public $likedate;

    function exchangeArray($data)
	{
		$this->likeid = (!empty($data['likeid'])) ? $data['likeid'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->AID = (!empty($data['AID'])) ? $data['AID'] : null;
        $this->uploadId = (!empty($data['uploadId'])) ? $data['uploadId'] : null;
        $this->likedate = (!empty($data['likedate'])) ? $data['likedate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
