<?php
	namespace Album\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class notificationdetailsTable
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
                    'notificationid' => $rSet->notificationid,
                    'UID' => $rSet->UID,
                    'notified_by' => $rSet->notified_by,
                    'notify_id' => $rSet->notify_id,
                    'notify_type' => $rSet->notify_type,
                    'notify_seen' => $rSet->notify_seen,
                    'notificationdate' => $rSet->notificationdate
                    );
            }
            return $array;
        }
        public function insertNotification($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function updateNotification($data,$where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->update($data,$where);
            return $res;
        }
        public function deleteNotification($where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->delete($where);
            return $res;
        }
    }
?>
