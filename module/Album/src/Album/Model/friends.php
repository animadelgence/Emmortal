<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class friends
{
	public $friendsid;
    public $userid;
    public $friendsname;
    public $friendsemail;
    public $friendshipdate;
    public $requestaccept;
    public $relationshipstatus;
    

    function exchangeArray($data)
	{
		$this->friendsid = (!empty($data['friendsid'])) ? $data['friendsid'] : null;
		$this->userid = (!empty($data['userid'])) ? $data['userid'] : null;
		$this->friendsname = (!empty($data['friendsname'])) ? $data['friendsname'] : null;
        $this->friendsemail = (!empty($data['friendsemail'])) ? $data['friendsemail'] : null;
        $this->friendshipdate = (!empty($data['friendshipdate'])) ? $data['friendshipdate'] : null;
        $this->requestaccept = (!empty($data['requestaccept'])) ? $data['requestaccept'] : null;
        $this->relationshipstatus = (!empty($data['relationshipstatus'])) ? $data['relationshipstatus'] : null;
        
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
