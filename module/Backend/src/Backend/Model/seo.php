<?php
namespace Backend\Model;

class seo
{
	public $seoid;
    public $seopagetitle;
    public $seometadescription;
    public $seoOGimagepath;
    public $seoFaviconimagepath;
    public $creationDate;
    //public $bgimage;

	function exchangeArray($data)
	{
		$this->seoid = (!empty($data['seoid'])) ? $data['seoid'] : null;
		$this->seopagetitle = (!empty($data['seopagetitle'])) ? $data['seopagetitle'] : null;
		$this->seometadescription = (!empty($data['seometadescription'])) ? $data['seometadescription'] : null;
		$this->seoOGimagepath = (!empty($data['seoOGimagepath'])) ? $data['seoOGimagepath'] : null;
		$this->seoFaviconimagepath = (!empty($data['seoFaviconimagepath'])) ? $data['seoFaviconimagepath'] : null;
		$this->creationDate = (!empty($data['creationDate'])) ? $data['creationDate'] : null;
		//$this->bgimage = (!empty($data['bgimage'])) ? $data['bgimage'] : null;
	}

    public function getArrayCopy()
    {
         return get_object_vars($this);
    }


}
?>
