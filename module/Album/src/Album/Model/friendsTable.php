<?php
	namespace Album\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Session\Container;
    use Zend\Db\Sql\Sql;
    use Zend\Db\Sql\Predicate;
    use Zend\Db\Sql\Where;
    use Zend\Db\Sql\Select;
    class friendsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function fetchall($query) {
            $resultSet = $this->tableGWay->select($query);
            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                    'id' => $rSet->id,
                    'userid' => $rSet->userid,
                    'friendsid' => $rSet->friendsid,
                    'friendshipdate' => $rSet->friendshipdate,
                    'requestaccept' => $rSet->requestaccept,
                    'relationshipstatus' => $rSet->relationshipstatus
                    );
            }
            return $array;
        }
        public function joinquery($condition,$join){
           $sql = new Sql($this->tableGWay->adapter);
           $select = $sql->select();
           $select->from($this->tableGWay->getTable())
                 ->join('user', $join)
                 ->where($condition);
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
                        'uniqueUser' => $rSet->uniqueUser
                 );
		   }
           return $data;
	    }
        public function insertFirend($query){
            $this->tableGWay->insert($query);
            $id = $this->tableGWay->lastInsertValue;
            return $id;
        }
        public function updateData($data,$where)
        {
            $res = $this->tableGWay->update($data,$where);
            return $res;
        }
    }
?>
