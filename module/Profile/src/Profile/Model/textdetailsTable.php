<?php
	namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class textdetailsTable
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
                    'textid' => $rSet->textid,
                    'UID' => $rSet->UID,
                    'title' => $rSet->title,
                    'description' => $rSet->description,
                    'AID' => $rSet->AID,
                    'friendsid' => $rSet->friendsid,
                    'addeddate' => $rSet->addeddate
                    );
            }
            return $array;
        }
        public function insertText($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function updateText($data,$where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->update($data,$where);
            return $res;
        }
        public function deleteSection($where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->delete($where);
            return $res;
        }
    }
?>
