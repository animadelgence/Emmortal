<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Plugin\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class PlugintestController extends AbstractActionController
 {
     public function indexAction()
     {
        $plugin = $this->routeplugin();
		$dynamicPath =  $plugin->dynamicPath();
		echo $dynamicPath;exit;
     }

 }
