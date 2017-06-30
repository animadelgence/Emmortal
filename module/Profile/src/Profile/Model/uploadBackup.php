<?php
namespace Profile\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class uploadBackup
{
    public $delid;
	public $uploadId;
    public $userid;
    public $uploadTitle;
    public $uploadDescription;
    public $uploadType;
    public $uploadPath;
    public $filestatus;
    public $AID;
    public $FID;
    public $PID;
    public $deletedate;


    function exchangeArray($data)
	{
		$this->delid = (!empty($data['delid'])) ? $data['delid'] : null;
		$this->uploadId = (!empty($data['uploadId'])) ? $data['uploadId'] : null;
		$this->userid = (!empty($data['userid'])) ? $data['userid'] : null;
		$this->uploadTitle = (!empty($data['uploadTitle'])) ? $data['uploadTitle'] : null;
        $this->uploadDescription = (!empty($data['uploadDescription'])) ? $data['uploadDescription'] : null;
        $this->uploadType = (!empty($data['uploadType'])) ? $data['uploadType'] : null;
        $this->filestatus = (!empty($data['filestatus'])) ? $data['filestatus'] : null;
        $this->AID = (!empty($data['AID'])) ? $data['AID'] : null;
        $this->FID = (!empty($data['FID'])) ? $data['FID'] : null;
        $this->uploadPath = (!empty($data['uploadPath'])) ? $data['uploadPath'] : null;
        $this->PID = (!empty($data['PID'])) ? $data['PID'] : null;
        $this->deletedate = (!empty($data['deletedate'])) ? $data['deletedate'] : null;

	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
