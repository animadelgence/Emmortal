<?php

namespace Dashboard\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;

class alltracker {

    public $id;
    public $ip;
    public $alldetails;
    public $trackdate;

    function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
        $this->alldetails = (!empty($data['alldetails'])) ? $data['alldetails'] : null;
        $this->trackdate = (!empty($data['trackdate'])) ? $data['trackdate'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

?>
