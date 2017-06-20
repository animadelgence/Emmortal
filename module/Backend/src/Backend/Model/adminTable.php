<?php
	namespace Admin\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Session\Container;

    class adminTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }

        public function loginsubmit($query)
        {

            $rowset = $this->tableGWay->select($query);
		    $data=array();
		    foreach($rowset as $rset)
		      {
			     $data[]=array(
					'adminID' => $rset->adminID,
                    'username' => $rset->username,
                    'password' => $rset->password);
		      }
		    return $data;
        }

    }
?>
