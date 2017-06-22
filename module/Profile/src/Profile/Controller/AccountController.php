<?php
namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class AccountController extends AbstractActionController {

	protected $sessionid;
	public function __construct() {

        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        /*$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath);
            exit;
        }*/
    }


	public function myaccountAction(){
//echo "hi from account controller";exit;changedetails

    	$this->layout('layout/profilelayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $uploadPlugin = $this->imageuploadplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];

		$this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'sessionid'=>$this->sessionid));
        return new ViewModel(array('userid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
	}
	public function profileimageAction(){
		$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $uploadPlugin = $this->imageuploadplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];

        $res = array();
        $request1 = $this->getRequest()->getPost();
        $filename = $request1['filename'];
        $value = $request1['value'];
        //echo $value;exit;
        //$getParam = $request1['param'];
        $request = $this->getRequest();
        $files = $request->getFiles()->toArray();
        $tmp_name = $files [$filename]['tmp_name'];
        $fileName = $files[$filename]['name'];
        //print_r($fileName);exit;
        $fileType = $files[$filename]['type'];
        $fileType = strtolower($fileType);
        $fileSize = ($files[$filename]['size'] / 1024) / 1024;

            $userID = $this->sessionid;
        if($value == "profile"){
            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/profileImage/' . $userID)) {
                @mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/profileImage/' . $userID, 0777, true);
                chmod($_SERVER['DOCUMENT_ROOT'] . '/upload/profileImage/' . $userID, 0777);
            }
        } else if($value == "background") {
           
            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/backgroundImage/' . $userID)) {
                @mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/backgroundImage/' . $userID, 0777, true);
                chmod($_SERVER['DOCUMENT_ROOT'] . '/upload/backgroundImage/' . $userID, 0777);
            }
        }

        
            $newfolderName =  $userID ;
        	$result = $uploadPlugin->upload($tmp_name , $fileName,$newfolderName,$value);
            //$input = json_decode($result, true);

            /*if($input['exterror'] == "0"){
                $data = array('profileImage' => $input['originalPath']);
                $sid = array('publisherId' => $PID);
                $updatedimage = $modelPlugin->getpublisherTable()->updateuser($data, $sid);
                $res['imagepath'] = $input['originalPath'];
            }
            $res['exterror'] = $input['exterror'];*/
            echo $result;

        exit;
	}

}
