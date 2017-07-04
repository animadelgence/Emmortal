<?php
	namespace Album\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class tributedetailsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function insertData($data)
        {
             return $rowset = $this->tableGWay->insert($data);
        }
        public function fetchall($query)
        {
            $resultSet = $this->tableGWay->select($query);
            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                            'tributesid' => $rSet->tributesid,
                            'UID' => $rSet->UID,
                            'description' => $rSet->description,
                            'friendsid' => $rSet->friendsid,
                            'uploadId' => $rSet->uploadId,
                            'addeddate' => $rSet->addeddate,
                        );
            }
            return $array;
        }
        public function joinquery($where,$join){
           $sql = new Sql($this->tableGWay->adapter);
           $select = $sql->select();
           $select->from($this->tableGWay->getTable())
                 ->join('user', $join)
                 ->where($where);
            $result = $this->tableGWay->selectWith($select);
            $data=array();
		    foreach($result as $rSet) {
			         $data[]=array(
                            'tributesid' => $rSet->tributesid,
                            'UID' => $rSet->UID,
                            'description' => $rSet->description,
                            'friendsid' => $rSet->friendsid,
                            'uploadId' => $rSet->uploadId,
                            'addeddate' => $rSet->addeddate,
                            'userid' => $rSet->userid,
                            'emailid' => $rSet->emailid,
                            'password' => $rSet->password,
                            'forgetpassword' => $rSet->forgetpassword,
                            'firstname' => $rSet->firstname,
                            'lastname' => $rSet->lastname,
                            'profileimage' => $rSet->profileimage,
                            'backgroundimage' => $rSet->backgroundimage,
                            'signindate' => $rSet->signindate,
                            'login' => $rSet->login,
                            'lastlogout' => $rSet->lastlogout,
                            'dateofbirth'=>$rSet->dateofbirth,
                            'keepmelogin' => $rSet->keepmelogin,
                            'seeme' => $rSet->seeme,
                            'findme' => $rSet->findme,
                            'content' => $rSet->content,
                            'activation' => $rSet->activation
			         );
		   }

           return $data;
	    }
    }
?>
