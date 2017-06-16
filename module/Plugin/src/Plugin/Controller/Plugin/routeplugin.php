<?php
namespace Plugin\Controller\Plugin;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class routeplugin extends AbstractPlugin{

    public function dynamicPath()
    {
        $protocol = $this->protocol();
        $dynamicPath = $protocol . $_SERVER["SERVER_NAME"];
        return $dynamicPath;
    }
    public function jsondynamic()
    {
        $testPath = $this->getController()->getServiceLocator()->get('Config');
        $jsonarray = array();
        $jsonarray = $testPath['json']['jsonvariable'];
        return $jsonarray;
    }
    public function protocol()
    {
        $protocol = '';
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        return $protocol;
    }
    public function curPageURL()
    {
        $pageURL = 'http';
        if (@$_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            if ($_SERVER["REQUEST_URI"] == "/")
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/Album/allalbum';
            elseif ($_SERVER["REQUEST_URI"] == "/index")
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/Album/allalbum';
            else
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else {
            if ($_SERVER["REQUEST_URI"] == "/")
                $pageURL .= $_SERVER["SERVER_NAME"] . '/Album/allalbum';
            elseif ($_SERVER["REQUEST_URI"] == "/index")
                $pageURL .= $_SERVER["SERVER_NAME"] . '/Album/allalbum';
            else
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
    public function encrypt_decrypt($action, $string) {
        $output = false;
        $key = '5faNIYoC17eL9G8ph6gvS7e2p625m9zN';
        $iv = md5(md5($key));
        if ($action == 'encrypt') {
            $output = md5($key) . "|\/|" . $string . "|\/|" . $iv;
            $output = base64_encode($output);
            return $output;
        } else if ($action == 'decrypt') {
            $output = base64_decode($output);
            $output = explode("|\/|", $output);
            return $output[1];
        }
    }
}
?>
