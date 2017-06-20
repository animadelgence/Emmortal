<?php

namespace Backend\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;
 use Zend\Session\SessionManager;

 class AdminloginController extends AbstractActionController
 {

    public function loginAction(){
		$userSessionAdmin 	= 	new Container('username');
		$sessionidAdmin 	= 	$userSessionAdmin->offsetGet('adminID');
        $plugin = $this->routeplugin();
		$dynamicPath = $plugin->dynamicPath();
        if($sessionidAdmin != "")
		{
			 return $this->redirect()->toRoute('usermanage', array(
				'controller' => 'usermanage',
				'action' => 'userdetails'));
		}
		else{
			$this->layout('layout/loginlayout');
			$plugin = $this->routeplugin();
		    $currentPageURL = $plugin->curPageURL();
			$href = explode("/", $currentPageURL);
			$controller = @$href[3];
			$action = @$href[4];
			$this->layout()->setVariables(array('controller'=>$controller,'action'=>$action,'dynamicPath' => $dynamicPath));
			return new ViewModel();
		}
    }
    public function submitAction()
	{
        $modelPlugin = $this->modelplugin();
        //$phpprenevt = $this->phpinjectionpreventplugin();
		//$userName = $phpprenevt->stringReplace($_POST['userId']);
        //$password = $phpprenevt->stringReplace($_POST['password']);
        $userName = $_POST['userId'];
        $password = $_POST['password'];
        $query = array('username'=>$userName,'password'=>$password);
		$checkLogin = $modelPlugin->getadminTable()->loginsubmit($query);
        if(!empty($checkLogin)){
		  if(isset($checkLogin[0]['adminID'])) {
			 $userSessionAdmin 			    = 	new Container('username');
             $userSessionAdmin->username 	= 	$checkLogin[0]['username'];
			 $userSessionAdmin->adminID 	= 	$checkLogin[0]['adminID'];
          }
            echo 'ok';
		}
        else {
            echo 'error';
         }
        exit;
	}
    public function logoutAction()
	{
        $userSessionAdmin  = 	new Container('username');
		$userSessionAdmin->getManager()->destroy();
		unset($userSessionAdmin->adminID);
		return $this->redirect()->toRoute('adminlogin', array(
					'controller' => 'adminlogin',
					'action' => 'login'
			));
	}



 }
?>
