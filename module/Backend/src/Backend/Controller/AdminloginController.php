<?php

namespace Backend\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;
 use Zend\Session\SessionManager;

 class AdminloginController extends AbstractActionController
 {

    public function loginAction(){
//        echo '1'."<br />"; //WORKS
//		$userSessionAdmin 	= 	new Container('username');
//		$sessionidAdmin 	= 	$userSessionAdmin->offsetGet('adminID');
        $plugin = $this->routeplugin();
		$dynamicPath = $plugin->dynamicPath();
//        echo $dynamicPath; exit; //WORKS
//        if($sessionidAdmin != "")
//		{
//			 return $this->redirect()->toRoute('userregistration', array(
//				'controller' => 'userregistration',
//				'action' => 'userdetails'));
//		}
//		else{
			$this->layout('layout/adminloginlayout');
			//$plugin = $this->routeplugin();
           // print_r($plugin)."<br />"; exit; //WORKS
		    $currentPageURL = $plugin->curPageURL();
            //echo $currentPageURL; exit; //WORKS
			$href = explode("/", $currentPageURL);
			$controller = @$href[3];
			$action = @$href[4];
			//$this->layout()->setVariables(array('controller'=>$controller,'action'=>$action,'dynamicPath' => $dynamicPath));
            $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
			return new ViewModel();
		}
//    }
//    public function submitAction()
//	{
//        $modelPlugin = $this->modelplugin();
//        $phpprenevt = $this->phpinjectionpreventplugin();
//		$userName = $phpprenevt->stringReplace($_POST['userId']);
//        $password = $phpprenevt->stringReplace($_POST['password']);
//        $query = array('username'=>$userName,'password'=>$password);
//		$checkLogin = $modelPlugin->getadminTable()->loginsubmit($query);
//        if(!empty($checkLogin)){
//		  if(isset($checkLogin[0]['adminID'])) {
//			 $userSessionAdmin 			    = 	new Container('username');
//             $userSessionAdmin->username 	= 	$checkLogin[0]['username'];
//			 $userSessionAdmin->adminID 	= 	$checkLogin[0]['adminID'];
//          }
//            echo 'ok';
//		}
//        else {
//            echo 'error';
//         }
//        exit;
//	}
//    public function logoutAction()
//	{
//        $userSessionAdmin  = 	new Container('username');
//		$userSessionAdmin->getManager()->destroy();
//		unset($userSessionAdmin->adminID);
//		return $this->redirect()->toRoute('adminlogin', array(
//					'controller' => 'adminlogin',
//					'action' => 'login'
//			));
//	}



 }
?>
