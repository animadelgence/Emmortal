<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class albumdetails
{
	public $albumeid;
    public $UID;
    public $albumimagepath;
    public $friendsid;
    public $title;
    public $description;
    public $color;
    public $viewstatus;
    public $creationdate;

    function exchangeArray($data)
	{
		$this->albumeid = (!empty($data['albumeid'])) ? $data['albumeid'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->albumimagepath = (!empty($data['albumimagepath'])) ? $data['albumimagepath'] : null;
        $this->friendsid = (!empty($data['friendsid'])) ? $data['friendsid'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->color = (!empty($data['color'])) ? $data['color'] : null;
        $this->viewstatus = (!empty($data['viewstatus'])) ? $data['viewstatus'] : null;
        $this->creationdate = (!empty($data['creationdate'])) ? $data['creationdate'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
