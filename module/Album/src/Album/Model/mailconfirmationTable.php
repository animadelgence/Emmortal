<?php
	namespace Album\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class mailconfirmationTable
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
                    'mailCatagory' => $rSet->mailCatagory,
                    'mailTemplate' => $rSet->mailTemplate,
                    );
            }
            return $array;
        }
    }
?>
