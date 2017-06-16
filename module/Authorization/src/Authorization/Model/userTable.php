<?php
	namespace Authorization\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class userTable
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
                    'keepmelogin' => $rSet->keepmelogin,
                    'seeme' => $rSet->seeme,
                    'findme' => $rSet->findme,
                    'content' => $rSet->content,
                    'activation' => $rSet->activation
                    );
            }
            return $array;
        }
        public function savedata($insertdataarray,$keyArray)
        {
            $resultSet = $this->tableGWay->select($keyArray);
            if(count($resultSet) == 0)
            {
                $rowset = $this->tableGWay->insert($insertdataarray);
            }
            else
            {
                $rowset = 0;
            }
            //$rowset = $this->tableGWay->insert($insertdataarray);
            //$id = $this->tableGWay->lastInsertValue;
           // return $id;
            return $rowset;
        }
        public function updateuser($data,$marker)
        {
            $res = $this->tableGWay->update($data,$marker);
            return $res;
            exit;

        }
    }
?>
