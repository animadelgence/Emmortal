<?php
	namespace Authorization\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class trackdetailsTable
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
                    'ip' => $rSet->ip,
                    'trackserverdetails' => $rSet->trackserverdetails,
                    'trackdate' => $rSet->trackdate
                    );
            }
            return $array;
        }
    }
?>
