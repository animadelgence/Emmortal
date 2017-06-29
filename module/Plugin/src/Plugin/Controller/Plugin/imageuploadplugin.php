<?php

namespace Plugin\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class imageuploadplugin extends AbstractPlugin {
	public function upload($tempname,$name,$newfoldername,$valuecondition)
     {
        $res                        = array();
        $tmp_name                   = $tempname;
        $uploadfilename             = $name;
        $savedate                   = time();
        
        $value                      =  pathinfo($uploadfilename, PATHINFO_EXTENSION);

        if ($value == 'png' || $value == 'jpg' || $value == 'jpeg' || $value == 'gif') {

            $returnImage            = $newfoldername."/".$savedate."_".$uploadfilename;

            if($valuecondition == 'profile') {

                $newfilename        = $_SERVER['DOCUMENT_ROOT'].'/upload/profileImage/'.$newfoldername."/".($savedate."_".$uploadfilename);

            } else if($valuecondition == "background") {

                $newfilename = $_SERVER['DOCUMENT_ROOT'].'/upload/backgroundImage/'.$newfoldername."/".($savedate."_".$uploadfilename);
            }         
            if (move_uploaded_file($tmp_name, $newfilename)) {
                   $res['filePath'] = $returnImage;
            } else {
                    $res['error']   = 0;
            }

        } else {

            $res['error']           = 1;

        }
        
        return json_encode($res);


     }

    //for admin background image edit
    public function bgimgedit($tempname,$name)
     {
        $res                        = array();
        $tmp_name                   = $tempname;
        $uploadfilename             = $name;
        $savedate                   = time();
        $value                      = pathinfo($uploadfilename, PATHINFO_EXTENSION);

        if ($value == 'png' || $value == 'jpg' || $value == 'jpeg' || $value == 'gif') {

            $newfilename = $_SERVER['DOCUMENT_ROOT'].'/upload/bgimg/'.($uploadfilename);
            if (move_uploaded_file($tmp_name, $newfilename)) {
                   $res['filePath'] = $uploadfilename;
            } else {
                    $res['error']   = 0;
            }
        } else {
            $res['error']           = 1;

        }
        return json_encode($res);

     }

}
?>
