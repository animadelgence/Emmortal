<?php
namespace Profile\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class textdetails
{
	public $textid;
    public $UID;
    public $title;
    public $description;
    public $AID;
    public $friendsid;
    public $addeddate;

    function exchangeArray($data)
	{
		$this->textid = (!empty($data['textid'])) ? $data['textid'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->AID = (!empty($data['AID'])) ? $data['AID'] : null;
        $this->friendsid = (!empty($data['friendsid'])) ? $data['friendsid'] : null;
        $this->addeddate = (!empty($data['addeddate'])) ? $data['addeddate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
