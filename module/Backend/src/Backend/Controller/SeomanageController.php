<?php
namespace Backend\Controller;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;

 class SeomanageController extends AbstractActionController
 {
     public function __construct() {
        $userSessionAdmin 	= 	new Container('username');
		$sessionidAdmin 	= 	$userSessionAdmin->offsetGet('adminID');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol.$_SERVER['HTTP_HOST'];
        if($sessionidAdmin == "")
		{
		header("Location:".$dynamicPath."/adminlogin/login");
			exit;
		}
     }

     public function seoviewAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $seodata = $modelPlugin->getseoTable()->fetchall();
		      return new ViewModel(array('seodata'=>$seodata));
     }
     public function editseoAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $id = $this->getEvent()->getRouteMatch()->getParam('id');
              $seodata = $modelPlugin->getseoTable()->fetchall(array('seoid'=>$id));
		      return new ViewModel(array('seodata'=>$seodata));
     }
     public function editseosubmitAction(){
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		     // $currentPageURL = $plugin->curPageURL();
              $seoId = $_POST['seoId'];
              $seoTitle = $_POST['seoTitle'];
              $metaDesc = $_POST['metaDesc'];
              $imgPath = $_POST['imgPath'];
              $favicon = $_POST['favicon'];
              $where = array('seoid'=>$seoId);
              $data = array('seopagetitle'=>$seoTitle,'seometadescription'=>$metaDesc,'seoOGimagepath'=>$imgPath,'seoFaviconimagepath'=>$favicon);
              $seodata = $modelPlugin->getseoTable()->updateData($data,$where);
		      return $this->redirect()->toRoute('seomanage', array(
				      'controller' => 'seomanage',
				      'action'     => 'seoview'));

     }
     public function bgeditAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $bgimg = $modelPlugin->getbgimageTable()->fetchall();
		      return new ViewModel(array('bgimg'=>$bgimg));

     }
     public function bgeditsubmitAction(){
              $modelPlugin  = $this->modelplugin();
              $plugin       = $this->routeplugin();
              $uploadPlugin = $this->imageuploadplugin();
              $dynamicPath  = $plugin->dynamicPath();
              $jsonArray    = $plugin->jsondynamic();
		      $currentPageURL = $plugin->curPageURL();
              $id = $_POST['bgimgid'];
              $filename = $_FILES['fileupload']['name'];
              $bgimgpath = $dynamicPath."/upload/bgimg/".$filename;
              $where = array('bgimgid'=>$id);
              $data = array('bgimgpath'=>$bgimgpath);
              $imgUpdate = $modelPlugin->getbgimageTable()->updateData($data,$where);

              //upload in bgimg folder(start)
              $href              = explode("/", $currentPageURL);
              $controller        = @$href[3];
              $action            = @$href[4];

              $res               = array();
              $request           = $this->getRequest();
              $files             = $request->getFiles()->toArray();
              $tmp_name          = $_FILES['fileupload']['tmp_name'];
              $fileNamewithspace = $_FILES['fileupload']['name'];
              $fileName          = str_replace("","_",$fileNamewithspace);
              $fileType          = $_FILES['fileupload']['type'];
              $fileType          = strtolower($fileType);
              $fileSize          = ($_FILES['fileupload']['size'] / 1024) / 1024;

              if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/bgimg')) {
                      @mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/bgimg', 0777, true);
                      chmod($_SERVER['DOCUMENT_ROOT'] . '/upload/bgimg/', 0777);
                  }

              $result = $uploadPlugin->bgimgedit($tmp_name , $fileName);
              //upload in bgimg folder(end)

              return $this->redirect()->toRoute('seomanage', array(
				      'controller' => 'seomanage',
				      'action'     => 'seoview'));

     }
     public function patternAction(){
              $modelPlugin = $this->modelplugin();

              $patternFolder = $_SERVER['DOCUMENT_ROOT'] . '/pattern/';
              //echo $patternFolder; exit;

                $getdynamicPath = $modelPlugin->dynamicPath();
                $filetype = '*.*';
                $files = glob($patternFolder . $filetype);
                $count = count($files);
                $patternFolderList = array();
                $response = array();
                for ($i = 0; $i < $count; $i++) {
                    $patternFolderList[$i] = $files[$i];
                }
                    ksort($patternFolderList);
                    $countpattern = 0;
                    foreach ($patternFolderList as $filename)
                    {
                        $getFile = explode($_SERVER['DOCUMENT_ROOT'],$filename);
                        //print_r($getFile); exit;
                        $thumbNailImageExplode = explode("/",$getFile[1]);
                        $getThumNail = "/pattern/thumbnail/".$thumbNailImageExplode[2];
                        $response[$countpattern] =  '<li class="emmortal-tab-pattern__list-item col-sm-2"><strong><a href="'.@$getdynamicPath.$getFile[1].'" title="Loading image" class="emmortal-tab-pattern__link"><img class="pattern" alt="emmortal-pattern" src="'.@$getdynamicPath.$getThumNail.'" class="emmortal-tab-pattern__link-img"/></a></strong></li>';
                        $countpattern = $countpattern + 1;

                    }
         echo  json_encode($response);exit;

     }


 }
