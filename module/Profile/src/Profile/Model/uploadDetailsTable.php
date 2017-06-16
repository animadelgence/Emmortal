<?php
	namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class uploadDetailsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function fetchall($query)
        {
            $resultSet = $this->tableGWay->select($query);
            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                    'uploadId' => $rSet->uploadId,
                    'UID' => $rSet->UID,
                    'uploadTitle' => $rSet->uploadTitle,
                    'uploadDescription' => $rSet->uploadDescription,
                    'AID' => $rSet->AID,
                    'FID' => $rSet->FID,
                    'PID' => $rSet->PID,
                    'TimeStamp' => $rSet->TimeStamp
                    );
            }
            return $array;
        }
        public function insertData($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function updateData($data,$where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->update($data,$where);
            return $res;
        }
        public function deleteData($where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->delete($where);
            return $res;
        }
    }
?>
