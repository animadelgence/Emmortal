<?php
namespace Plugin\Controller\Plugin;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class videouploadplugin extends AbstractPlugin{
	 public function videoupload($tempname,$name)
    {
    	$res = array();
    	$tmp_name =$tempname;
        $uploadfilename = $name;
        $savedate=time();
        $value =  pathinfo($uploadfilename, PATHINFO_EXTENSION);
        if ($value == 'webm' || $value == 'mp4' || $value == 'ogv' || $value == 'mov') {
	        $returnImage = $savedate."_".$uploadfilename;
	        $newfilename = $_SERVER['DOCUMENT_ROOT'].'/upload/video/'.($savedate."_".$uploadfilename);
		        if (move_uploaded_file($tmp_name, $newfilename)){
		           $res['filePath'] = $returnImage;
		    	}else {
		    		$res['error'] = 0;

		    	}
		} else {
				$res['error'] = 1;

				}
	    return json_encode($res);
    }
}