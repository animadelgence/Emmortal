<?php
	namespace Album\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class likesdetailsTable
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
                    'likeid' => $rSet->likeid,
                    'UID' => $rSet->UID,
                    'AID' => $rSet->AID,
                    'TID' => $rSet->TID,
                    'FID' => $rSet->FID,
                    'uploadId' => $rSet->uploadId,
                    'likedate' => $rSet->likedate
                    );
            }
            return $array;
        }
        public function insertLike($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function updateLike($data,$where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->update($data,$where);
            return $res;
        }
        public function deleteLike($where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->delete($where);
            return $res;
        }
        public function countLike($uploadId){
            $resultSet = $this->tableGWay->select($uploadId);
            $likeCount = count($resultSet);
            return $likeCount;

        }
    }
?>
