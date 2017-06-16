<?php

namespace Dashboard\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Digits;

class usertemplatebackup {

    public $deletedusertemplateId;
    public $PID;
    public $tempId;
    public $appId;
    public $appSecret;
    public $campaignNumber;
    public $templateLink;
    public $campaignName;
    public $webUrl;
    public $facebookUrl;
    public $wordpressUrl;
    public $domainUrl;
    public $facebookNo;
    public $facebookPage;
    public $facebookTabName;
    public $publishStatus;
    public $Duplicate;
    public $formId;
    public $timeStamp;
    public $pageId;
    public $deleteDate;

    function exchangeArray($data) {
        $this->deletedusertemplateId = (!empty($data['deletedusertemplateId'])) ? $data['deletedusertemplateId'] : null;
        $this->PID = (!empty($data['PID'])) ? $data['PID'] : null;
        $this->tempId = (!empty($data['tempId'])) ? $data['tempId'] : null;
        $this->appId = (!empty($data['appId'])) ? $data['appId'] : null;
        $this->appSecret = (!empty($data['appSecret'])) ? $data['appSecret'] : null;
        $this->campaignNumber = (!empty($data['campaignNumber'])) ? $data['campaignNumber'] : null;
        $this->templateLink = (!empty($data['templateLink'])) ? $data['templateLink'] : null;
        $this->campaignName = (!empty($data['campaignName'])) ? $data['campaignName'] : null;
        $this->webUrl = (!empty($data['webUrl'])) ? $data['webUrl'] : null;
        $this->facebookUrl = (!empty($data['facebookUrl'])) ? $data['facebookUrl'] : null;
        $this->wordpressUrl = (!empty($data['wordpressUrl'])) ? $data['wordpressUrl'] : null;
        $this->domainUrl = (!empty($data['domainUrl'])) ? $data['domainUrl'] : null;
        $this->facebookNo = (!empty($data['facebookNo'])) ? $data['facebookNo'] : null;
        $this->facebookPage = (!empty($data['facebookPage'])) ? $data['facebookPage'] : null;
        $this->facebookTabName = (!empty($data['facebookTabName'])) ? $data['facebookTabName'] : null;
        $this->publishStatus = (!empty($data['publishStatus'])) ? $data['publishStatus'] : null;
        $this->Duplicate = (!empty($data['Duplicate'])) ? $data['Duplicate'] : null;
        $this->formId = (!empty($data['formId'])) ? $data['formId'] : null;
        $this->timeStamp = (!empty($data['timeStamp'])) ? $data['timeStamp'] : null;
        $this->pageId = (!empty($data['pageId'])) ? $data['pageId'] : null;
        $this->deleteDate = (!empty($data['deleteDate'])) ? $data['deleteDate'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

?>
