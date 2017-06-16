<?php

namespace Dashboard\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Session\Container;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;

class usertemplatebackupTable {

    protected $tableGateWay;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGWay = $tableGateway;
    }

    public function fetchall($query) {
        $resultSet = $this->tableGWay->select($query);
        $array = array();
        foreach ($resultSet as $rSet) {
            $array[] = array(
                'usertemplateId' => $rSet->usertemplateId,
                'PID' => $rSet->PID,
                'tempId' => $rSet->tempId,
                'appId' => $rSet->appId,
                'appSecret' => $rSet->appSecret,
                'campaignNumber' => $rSet->campaignNumber,
                'campaignName' => $rSet->campaignName,
                'templateLink' => $rSet->templateLink,
                'webUrl' => $rSet->webUrl,
                'facebookUrl' => $rSet->facebookUrl,
                'wordpressUrl' => $rSet->wordpressUrl,
                'facebookNo' => $rSet->facebookNo,
                'facebookPage' => $rSet->facebookPage,
                'facebookTabName' => $rSet->facebookTabName,
                'publishStatus' => $rSet->publishStatus,
                'Duplicate' => $rSet->Duplicate,
                'formId' => $rSet->formId,
                'pageId' => $rSet->pageId,
                'timeStamp' => $rSet->timeStamp
            );
        }
        return $array;
    }

    public function saveUserdet($data) { //insert data
        $rowset = $this->tableGWay->insert($data);
        return $rowset;
    }

}

?>
