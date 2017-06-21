<?php

namespace Plugin\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class imageuploadplugin extends AbstractPlugin {
	public function upload($tempname,$name,$newfoldername)
     {
      $res = array();
        $tmp_name =$tempname;
        $uploadfilename = $name;
        $savedate=time();
        //return $foldername;
        $value =  pathinfo($uploadfilename, PATHINFO_EXTENSION);
        //return $newfilename = $_SERVER['DOCUMENT_ROOT'].'/image/profileimage/'.$newfoldername."/".($savedate."_".$uploadfilename);
       // return $value;
        if ($value == 'png' || $value == 'jpg' || $value == 'jpeg' || $value == 'gif') {
            $returnImage = $newfoldername."/".$savedate."_".$uploadfilename;
            $newfilename = $_SERVER['DOCUMENT_ROOT'].'/image/profileImage/'.$newfoldername."/".($savedate."_".$uploadfilename);
           // chmod($_SERVER['DOCUMENT_ROOT'] . '/image/profileImage/' . $newfoldername, 0777);
            
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
?>
