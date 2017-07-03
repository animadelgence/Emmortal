<ul class="emmortal-tab-pattern__list">
            <?php
            $patternFolder = $_SERVER['DOCUMENT_ROOT'] . '/pattern/';
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $getdynamicPath = $protocol.$_SERVER['HTTP_HOST'];
                $filetype = '*.*';
                $files = glob($patternFolder . $filetype);
                $count = count($files);
                $patternFolderList = array();
                for ($i = 0; $i < $count; $i++) {
                    $patternFolderList[$i] = $files[$i];
                }
                    ksort($patternFolderList);
                    $countpattern = 1;
                    foreach ($patternFolderList as $filename)
                    {
                        $countpattern = $countpattern + 1;
                        $getFile = explode($_SERVER['DOCUMENT_ROOT'],$filename);
                        $thumbNailImageExplode = explode("/",$getFile[1]);
                        $getThumNail = "/pattern/thumbnail/".$thumbNailImageExplode[2];
                        echo '<li class="emmortal-tab-pattern__list-item"><strong><a href="'.@$getdynamicPath.$getFile[1].'" title="Loading image" class="emmortal-tab-pattern__link"><img alt="emmortal-pattern" src="'.@$getdynamicPath.$getThumNail.'" class="emmortal-tab-pattern__link-img"/></a></strong></li>';
                    }
                    ?>
</ul>
