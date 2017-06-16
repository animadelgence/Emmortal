<?php

namespace Dashboard\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Session\Container;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;  //creating a object type of select 2 access any table

class alltrackerTable {

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
                'id' => $rSet->id,
                'ip' => $rSet->ip,
                'alldetails' => $rSet->alldetails,
                'trackdate' => $rSet->trackdate);
        }
        return $array;
    }
     public function savedata($data) { 
        
        $rowset = $this->tableGWay->insert($data);
        return $rowset;
    }
    public function updateStep($data, $where) {
       
        $rowset = $this->tableGWay->update($data, $where);
        return $rowset;
    }

}

?>
