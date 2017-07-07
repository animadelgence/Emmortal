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
                    'dateofbirth'=>$rSet->dateofbirth,
                    'keepmelogin' => $rSet->keepmelogin,
                    'seeme' => $rSet->seeme,
                    'findme' => $rSet->findme,
                    'content' => $rSet->content,
                    'activation' => $rSet->activation,
                    'viewprofile' => $rSet->viewprofile,
                    'viewname' => $rSet->viewname,
                    'uniqueUser'=>$rSet->uniqueUser
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
                $resultSet = $this->tableGWay->selectWith($select);
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
                        'dateofbirth'=>$rSet->dateofbirth,
                        'keepmelogin' => $rSet->keepmelogin,
                        'seeme' => $rSet->seeme,
                        'findme' => $rSet->findme,
                        'content' => $rSet->content,
                        'activation' => $rSet->activation,
                        'uniqueUser'=>$rSet->uniqueUser
                        );
                }
                return $array;

        }
        public function savedata($insertdataarray,$keyArray)
        {
            //print_r($insertdataarray); exit;
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
            $id = $this->tableGWay->lastInsertValue;
           // return $id;
            return $id;
        }
        public function saverestore($query) {
            return $rowset = $this->tableGWay->insert($query);
        }
        public function updateuser($data,$marker)
        {
            $res = $this->tableGWay->update($data,$marker);
            return $res;
            exit;

        }

        public function joinquery($query){
           $sql = new Sql($this->tableGWay->adapter);
           $select = $sql->select();
           $select->from($this->tableGWay->getTable())
                 ->join('friends', 'user.userid = friends.userid')
                 ->where("user.userid='$query'");
            $result = $this->tableGWay->selectWith($select);
            $data=array();
		    foreach($result as $rSet) {
			         $data[]=array(
                            'id' => $rSet->id,
                            'userid' => $rSet->userid,
                            'friendsid' => $rSet->friendsid,
                            'friendshipdate' => $rSet->friendshipdate,
                            'requestaccept' => $rSet->requestaccept,
                            'relationshipstatus' => $rSet->relationshipstatus,
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
                            'activation' => $rSet->activation,
                            'uniqueUser'=>$rSet->uniqueUser
			         );
		   }
            print_r($data);exit;
           return $data;
	    }

        public function deleteuser($query) {
            $rowset = $this->tableGWay->select($query);
            $resultset = $this->tableGWay->delete($query);
            return $resultset;
        }
        public function fetchallData($query) {
            $sql = new Sql($this->tableGWay->adapter);
            $select = $sql->select();
            $select ->from($this->tableGWay->getTable())
                    ->where("userid != '$query'");
            $resultSet = $this->tableGWay->selectWith($select);
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
                    'dateofbirth'=>$rSet->dateofbirth,
                    'keepmelogin' => $rSet->keepmelogin,
                    'seeme' => $rSet->seeme,
                    'findme' => $rSet->findme,
                    'content' => $rSet->content,
                    'activation' => $rSet->activation,
                    'viewprofile' => $rSet->viewprofile,
                    'viewname' => $rSet->viewname,
                    'uniqueUser'=>$rSet->uniqueUser
                    );
                }
                return $array;
        }

    }
?>
