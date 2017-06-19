<?php
	namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class pagedetailsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function fetchall($data){
            $resultSet = $this->tableGWay->select($data);
            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                    'UID' => $rSet->UID,
                    'pageid' =>$rSet->pageid
                    );
            }
            return $array;
        }
        public function insertData($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }

    }
?>
