<?php

namespace Backend\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;


class PatterngetController extends AbstractActionController
 {
     public function getpatternAction(){
              $modelPlugin = $this->modelplugin();
              $patternFolder = $_SERVER['DOCUMENT_ROOT'] . '/pattern/';

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
                        $thumbNailImageExplode = explode("/",$getFile[1]);
                        $getThumNail = "/pattern/thumbnail/".$thumbNailImageExplode[2];
                        $response[$countpattern] =  '<li class="emmortal-tab-pattern__list-item col-sm-2"><strong><a href="'.@$getdynamicPath.$getFile[1].'" title="Loading image" class="emmortal-tab-pattern__link"><img class="pattern" alt="emmortal-pattern" src="'.@$getdynamicPath.$getThumNail.'" class="emmortal-tab-pattern__link-img"/></a></strong></li>';
                        $countpattern = $countpattern + 1;

                    }
            echo  json_encode($response);exit;

     }
}
?>
