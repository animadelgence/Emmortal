<?php
namespace Admin\Model;

class admin
{
	public $adminID;
    public $username;
    public $password;

	function exchangeArray($data)
	{
		$this->adminID = (!empty($data['adminID'])) ? $data['adminID'] : null;
		$this->username = (!empty($data['username'])) ? $data['username'] : null;
		$this->password = (!empty($data['password'])) ? $data['password'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
