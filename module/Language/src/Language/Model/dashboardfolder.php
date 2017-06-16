<?php

namespace Dashboard\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;

class dashboardfolder {

    public $dashboardfolderId;
    public $PID;
    public $folderName;
    public $timestamp;

    function exchangeArray($data) {
        $this->dashboardfolderId = (!empty($data['dashboardfolderId'])) ? $data['dashboardfolderId'] : null;
        $this->PID = (!empty($data['PID'])) ? $data['PID'] : null;
        $this->folderName = (!empty($data['folderName'])) ? $data['folderName'] : null;
        $this->timestamp = (!empty($data['timestamp'])) ? $data['timestamp'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

?>
