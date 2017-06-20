<?php
	namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;
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

        public function fetchPageId($data){
            $sql = new Sql($this->tableGWay->adapter);
            $select = $sql->select();
            $select->from($this->tableGWay->getTable())
                ->where($data);
            $select->order('createddate ASC');
            $resultSet = $this->tableGWay->selectWith($select);
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
            $rowset = $this->tableGWay->insert($data);
            $id = $this->tableGWay->lastInsertValue;
            return $id;
        }

    }
?>
