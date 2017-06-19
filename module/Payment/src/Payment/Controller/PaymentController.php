<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Payment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PaymentController extends AbstractActionController {

    public function indexAction() {
        echo "hello from payment ,work under progress";exit;
        
    }
    public function saveimageAction() {
        $request1 = $this->getRequest()->getPost();
        $filename = $request1['filename'];
        $request = $this->getRequest();
        $files = $request->getFiles()->toArray();
        $imageName = $files['file']['name'];
        $temp_name = $files['file']['tmp_name'];
        $filename = date("Y-m-d h:i:sa").' image'.$imageName;
        $newfilename = $_SERVER['DOCUMENT_ROOT'].'/image/'.$filename;

        if(move_uploaded_file($temp_name, $newfilename))
        {
            echo '/image/'.$filename;
            exit;
        }  
    }
    public function removeimageAction() {
        //echo 1; exit;
        $imagePath = $_POST['removeimage'];
        $path = $_SERVER['DOCUMENT_ROOT'].$imagePath;
        unlink($path);
        echo $imagePath ;
        exit;
    }
  

}
