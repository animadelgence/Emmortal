<?php
	namespace Authorization\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    use Zend\Db\Sql\Insert;

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
           // print_r($keyArray);//exit;
            $resultSet = $this->tableGWay->select($keyArray);
            //print_r($resultSet);exit;
            //echo count($resultSet);exit;
            
            if(count($resultSet) == 0)
            {
                //echo 1;
                $rowset = $this->tableGWay->insert('emailid' => 'amsdhf@dg.cb','password' => 'dsfsdfsd');
                echo $rowset;
            }
            else
            {
                $rowset = 0;
            }
            echo $rowset;exit;
            $rowset = $this->tableGWay->insert($insertdataarray);
            //$id = $this->tableGWay->lastInsertValue;
           // return $id;
            echo $this->tableGWay->insert($insertdataarray);
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
