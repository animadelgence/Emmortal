<?php

namespace Dashboard\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Session\Container;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;  //creating a object type of select 2 access any table

class dashboardfolderTable {

    protected $tableGateWay;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGWay = $tableGateway;
    }

    public function fetchall($query) {
        //print_r($query);exit;
        $resultSet = $this->tableGWay->select($query);
        $array = array();
        foreach ($resultSet as $rSet) {
            $array[] = array(
                'dashboardfolderId' => $rSet->dashboardfolderId,
                'PID' => $rSet->PID,
                'folderName' => $rSet->folderName,
                'timestamp' => $rSet->timestamp);
        }
        return $array;
    }

    public function savefolderdetails($conditionarray) {
        $insertdetails = $this->tableGWay->insert($conditionarray);
        //echo $insertdetails;exit;
        $id = $this->tableGWay->lastInsertValue;
        return $id;
        //}
    }

    public function delFolderId($id) {
        return $this->tableGWay->delete($id);
    }

    //public function updatedata($folderName,$folderId,$pubid)
    public function updatedata($data, $where) {
        $resultSetupdate = $this->tableGWay->update($data, $where);
        return 1;
        //}
    }

}

?>
