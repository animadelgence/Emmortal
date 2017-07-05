<?php
	namespace Album\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class albumdetailsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function fetchall()
        {
            $resultSet = $this->tableGWay->select();
            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                    'albumeid' => $rSet->albumeid,
                    'UID' => $rSet->UID,
                    'albumimagepath' => $rSet->albumimagepath,
                    'friendsid' => $rSet->friendsid,
                    'title' => $rSet->title,
                    'description' => $rSet->description,
                    'color' => $rSet->color,
                    'viewstatus' => $rSet->viewstatus,
                    'creationdate' => $rSet->creationdate
                    );
            }
            return $array;
        }
        public function insertalbum($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function insertalbumGetId($data)
        {
             $rowset = $this->tableGWay->insert($data);
             $id = $this->tableGWay->lastInsertValue;
             return $id;
        }
    }
?>
