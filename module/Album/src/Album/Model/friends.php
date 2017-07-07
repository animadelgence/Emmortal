<?php
namespace Album\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;
class friends
{
	public $id;
    public $userid;
    public $friendsid;
    public $friendshipdate;
    public $requestaccept;
    public $relationshipstatus;
    
    public $emailid;
    public $password;
    public $forgetpassword;
    public $firstname;
    public $lastname;
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
    public $uniqueUser;


    function exchangeArray($data)
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->userid = (!empty($data['userid'])) ? $data['userid'] : null;
		$this->friendsid = (!empty($data['friendsid'])) ? $data['friendsid'] : null;
        $this->friendshipdate = (!empty($data['friendshipdate'])) ? $data['friendshipdate'] : null;
        $this->requestaccept = (!empty($data['requestaccept'])) ? $data['requestaccept'] : null;
        $this->relationshipstatus = (!empty($data['relationshipstatus'])) ? $data['relationshipstatus'] : null;
        
		$this->emailid = (!empty($data['emailid'])) ? $data['emailid'] : null;
		$this->password = (!empty($data['password'])) ? $data['password'] : null;
        $this->forgetpassword = (!empty($data['forgetpassword'])) ? $data['forgetpassword'] : null;
        $this->firstname = (!empty($data['firstname'])) ? $data['firstname'] : null;
        $this->lastname = (!empty($data['lastname'])) ? $data['lastname'] : null;
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
        $this->uniqueUser = (!empty($data['uniqueUser'])) ? $data['uniqueUser'] : null;

	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
