<?php
namespace Profile\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class uploadDetails
{
	public $uploadId;
    public $UID;
    public $uploadTitle;
    public $uploadDescription;
    public $AID;
    public $FID;
    public $PID;
    public $TimeStamp;

    function exchangeArray($data)
	{
		$this->uploadId = (!empty($data['uploadId'])) ? $data['uploadId'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->uploadTitle = (!empty($data['uploadTitle'])) ? $data['uploadTitle'] : null;
        $this->uploadDescription = (!empty($data['uploadDescription'])) ? $data['uploadDescription'] : null;
        $this->AID = (!empty($data['AID'])) ? $data['AID'] : null;
        $this->FID = (!empty($data['FID'])) ? $data['FID'] : null;
        $this->PID = (!empty($data['PID'])) ? $data['PID'] : null;
        $this->TimeStamp = (!empty($data['TimeStamp'])) ? $data['TimeStamp'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
