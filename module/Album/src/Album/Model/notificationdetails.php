<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class notificationdetails
{
	public $notificationid;
    public $UID;
    public $notified_by;
    public $notify_id;
    public $notify_type;
    public $notify_seen;
    public $notificationdate;

    function exchangeArray($data)
	{
		$this->notificationid = (!empty($data['notificationid'])) ? $data['notificationid'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->notified_by = (!empty($data['notified_by'])) ? $data['notified_by'] : null;
		$this->notify_id = (!empty($data['notify_id'])) ? $data['notify_id'] : null;
		$this->notify_type = (!empty($data['notify_type'])) ? $data['notify_type'] : null;
        $this->notify_seen = (!empty($data['notify_seen'])) ? $data['notify_seen'] : null;
        $this->notificationdate = (!empty($data['notificationdate'])) ? $data['notificationdate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
