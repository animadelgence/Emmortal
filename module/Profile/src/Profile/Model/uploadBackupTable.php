<?php
	namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class uploadBackupTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }

        public function fetchall($query=null)
        {

            $resultSet = $this->tableGWay->select($query);
            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                    'delid' => $rSet->delid,
                    'uploadid' => $rSet->uploadid,
                    'userid' => $rSet->userid,
                    'uploadPath'=>$rSet->uploadPath,
                    'uploadTitle' => $rSet->uploadTitle,
                    'uploadDescription' => $rSet->uploadDescription,
                    'uploadType' => $rSet->uploadType,
                    'filestatus' => $rSet->filestatus,
                    'AID' => $rSet->AID,
                    'FID' => $rSet->FID,
                    'PID' => $rSet->PID,
                    'deletedate' => $rSet->deletedate
                    );
            }
            return $array;
        }

        public function insertdata($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function updateData($data,$where)
        {
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
