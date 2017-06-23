<?php
	namespace Authorization\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class userbackupTable
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
                    'deleteId' => $rSet->deleteId,
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
                    'activation' => $rSet->activation,
                    'deletedate' => $rSet->deletedate,
                    'flag' => $rSet->flag,
                    );
                }
                return $array;
        }
        public function fetchallnew()
        {
                $sql = new Sql($this->tableGWay->adapter);
		          $select = $sql->select();
                  $select->from($this->tableGWay->getTable())
                         ->order('userid DESC');
                $array = array();
                foreach ($resultSet as $rSet) {
                    $array[] = array(
                        'deleteId' => $rSet->deleteId,
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
                        'activation' => $rSet->activation,
                        'deletedate' => $rSet->deletedate,
                        'flag' => $rSet->flag
                        );
                }
                return $array;

        }
        public function insertdata($insertdataarray)
        {
            $rowset = $this->tableGWay->insert($insertdataarray);
            $id = $this->tableGWay->lastInsertValue;
            return $id;
            return $rowset;
        }
        public function updateuser($data,$marker)
        {
            $res = $this->tableGWay->update($data,$marker);
            return $res;
            exit;

        }
        public function deleteuser($query) {
                $rowset = $this->tableGWay->select($query);
                $resultset = $this->tableGWay->delete($query);
                return $resultset;
        }

    }
?>
