<?php
	namespace Authorization\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class trackdetailsafterloginTable
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
                    'UID' => $rSet->UID,
                    'trackpage' => $rSet->trackpage,
                    'trackserverdetails' => $rSet->trackserverdetails,
                    'trackdate' => $rSet->trackdate
                    );
            }
            return $array;
        }
    }
?>
