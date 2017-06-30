<?php
namespace Backend\Model;

class bgimage
{
	public $bgimgid;
    public $bgimgpath;
	function exchangeArray($data)
	{
		$this->bgimgid = (!empty($data['bgimgid'])) ? $data['bgimgid'] : null;
		$this->bgimgpath = (!empty($data['bgimgpath'])) ? $data['bgimgpath'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
