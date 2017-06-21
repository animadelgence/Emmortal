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
    public $uploadType;
    public $uploadPath;
    public $AID;
    public $FID;
    public $PID;
    public $TimeStamp;
    
    public $userid;
    public $emailid;
    public $password;
    public $forgetpassword;
    public $firstname;
    public $lastname;
    public $dateofbirth;
    public $profileimage;
    public $backgroundimage;
    public $signindate;
    public $login;
    public $lastlogout;
    public $keepmelogin;
    public $seeme;
    public $findme;
    public $content;
    public $activation;

    function exchangeArray($data)
	{
		$this->uploadId = (!empty($data['uploadId'])) ? $data['uploadId'] : null;
		$this->UID = (!empty($data['UID'])) ? $data['UID'] : null;
		$this->uploadTitle = (!empty($data['uploadTitle'])) ? $data['uploadTitle'] : null;
        $this->uploadDescription = (!empty($data['uploadDescription'])) ? $data['uploadDescription'] : null;
        $this->uploadType = (!empty($data['uploadType'])) ? $data['uploadType'] : null;
        $this->AID = (!empty($data['AID'])) ? $data['AID'] : null;
        $this->FID = (!empty($data['FID'])) ? $data['FID'] : null;
        $this->uploadPath = (!empty($data['uploadPath'])) ? $data['uploadPath'] : null;
        $this->PID = (!empty($data['PID'])) ? $data['PID'] : null;
        $this->TimeStamp = (!empty($data['TimeStamp'])) ? $data['TimeStamp'] : null;
        
        $this->userid = (!empty($data['userid'])) ? $data['userid'] : null;
		$this->emailid = (!empty($data['emailid'])) ? $data['emailid'] : null;
		$this->password = (!empty($data['password'])) ? $data['password'] : null;
        $this->forgetpassword = (!empty($data['forgetpassword'])) ? $data['forgetpassword'] : null;
        $this->firstname = (!empty($data['firstname'])) ? $data['firstname'] : null;
        $this->lastname = (!empty($data['lastname'])) ? $data['lastname'] : null;
        $this->dateofbirth = (!empty($data['dateofbirth'])) ? $data['dateofbirth'] : null;
        $this->profileimage = (!empty($data['profileimage'])) ? $data['profileimage'] : null;
        $this->backgroundimage = (!empty($data['backgroundimage'])) ? $data['backgroundimage'] : null;
        $this->signindate = (!empty($data['signindate'])) ? $data['signindate'] : null;
        $this->login = (!empty($data['login'])) ? $data['login'] : null;
        $this->lastlogout = (!empty($data['lastlogout'])) ? $data['lastlogout'] : null;
        $this->keepmelogin = (!empty($data['keepmelogin'])) ? $data['keepmelogin'] : null;
        $this->seeme = (!empty($data['seeme'])) ? $data['seeme'] : null;
        $this->findme = (!empty($data['findme'])) ? $data['findme'] : null;
        $this->content = (!empty($data['content'])) ? $data['content'] : null;
        $this->activation = (!empty($data['activation'])) ? $data['activation'] : null;
        
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
