<?php
    namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    use Zend\Db\Sql\Predicate;
    use Zend\Db\Sql\Where;
    use Zend\Db\Sql\Select;
    class uploadDetailsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function fetchalldatas($query)
        {
            $sql = new Sql($this->tableGWay->adapter);
            $select = $sql->select();
            $select->from($this->tableGWay->getTable())
                    ->where($query);
            $select->order('uploadId DESC');
            $resultSet = $this->tableGWay->selectWith($select);

            $array = array();
            foreach ($resultSet as $rSet) {
                $array[] = array(
                    'uploadId' => $rSet->uploadId,
                    'UID' => $rSet->UID,
                    'uploadPath'=>$rSet->uploadPath,
                    'uploadTitle' => $rSet->uploadTitle,
                    'uploadDescription' => $rSet->uploadDescription,
                    'uploadType' => $rSet->uploadType,
                    'albumcolor' => $rSet->albumcolor,
                    'sizeX' => $rSet->sizeX,
                    'sizeY' => $rSet->sizeY,
                    'AID' => $rSet->AID,
                    'FID' => $rSet->FID,
                    'PID' => $rSet->PID,
                    'TimeStamp' => $rSet->TimeStamp
                    );
            }
            return $array;
        }
        public function fetchall($query=null)
        {
        $sql = new Sql($this->tableGWay->adapter);
        $select = $sql->select();
        $select->from($this->tableGWay->getTable())
                ->where($query);
        $select->order('uploadId DESC');
        $resultSet = $this->tableGWay->selectWith($select);

        $array = array();


           // $resultSet = $this->tableGWay->select($query);
            $array = array();
            foreach ($resultSet as $rSet) {
                if($rSet->sizeX=="H")
                {
                    $sizeX = 1;$Height = "172px";
                }

                else
                {
                    $sizeX = 2;$Height = "364px";
                }

                 if($rSet->sizeY=="W")
                    {
                         $sizeY = 2;$Width = "364px";
                    }
                else
                   {
                         $sizeY = 1;$Width = "172px";
                    }
                $array[] = array(
                    'uploadId' => $rSet->uploadId,
                    'UID' => $rSet->UID,
                    'uploadPath'=>$rSet->uploadPath,
                    'uploadTitle' => $rSet->uploadTitle,
                    'uploadDescription' => $rSet->uploadDescription,
                    'uploadType' => $rSet->uploadType,
                    'albumcolor' => $rSet->albumcolor,
                    /*'sizeX' => $rSet->sizeX,
                    'sizeY' => $rSet->sizeY,*/
                    'sizeX' => $sizeX,
                    'sizeY' => $sizeY,
                    'height'=>$Height,
                    'width'=>$Width,
                    'AID' => $rSet->AID,
                    'FID' => $rSet->FID,
                    'PID' => $rSet->PID,
                    'TimeStamp' => $rSet->TimeStamp
                    );
            }
            return $array;
        }

        public function fetchAllData($query,$offsetvalues) {
        $sql = new Sql($this->tableGWay->adapter);
        $select = $sql->select();
        $select->from($this->tableGWay->getTable())
                ->where($query);
        $select->order('uploadId DESC');

        if (!empty($offsetvalues)) {
            $select->limit(15)
                    ->offset($offsetvalues);
            $result = $this->tableGWay->selectWith($select);
        }
        $array = array();
        foreach ($result as $rSet) {
            /*if($rSet->sizeX=="H")
                {
                    $sizeX = 1;$Height = "172px";
                }

                else
                {
                    $sizeX = 2;$Height = "364px";
                }

                 if($rSet->sizeY=="W")
                    {
                         $sizeY = 2;$Width = "364px";
                    }
                else
                   {
                         $sizeY = 1;$Width = "172px";
                    }*/
              $array[] = array(
                    'uploadId' => $rSet->uploadId,
                    'UID' => $rSet->UID,
                    'uploadPath'=>$rSet->uploadPath,
                    'uploadTitle' => $rSet->uploadTitle,
                    'uploadDescription' => $rSet->uploadDescription,
                    'uploadType' => $rSet->uploadType,
                    'albumcolor' => $rSet->albumcolor,
                    'sizeX' => $rSet->sizeX,
                    'sizeY' => $rSet->sizeY,
                    'AID' => $rSet->AID,
                    'FID' => $rSet->FID,
                    'PID' => $rSet->PID,
                    'TimeStamp' => $rSet->TimeStamp
                    );
        }
        return $array;
    }

        public function insertData($data)
        {
            $rowset = $this->tableGWay->insert($data);
            $id = $this->tableGWay->lastInsertValue;
            return $id;
        }
        public function updateData($data,$where)
        {
            $res = $this->tableGWay->update($data,$where);
            return $res;
        }
        public function deleteData($where)
        {
            $rowset = $this->tableGWay->select($where);
            $res = $this->tableGWay->delete($where);
            return $res;
        }
        public function joinquery($query){
           $sql = new Sql($this->tableGWay->adapter);
           $select = $sql->select();
           $select->from($this->tableGWay->getTable())
                 ->join('user', 'uploadDetails.UID = user.userid')
                 ->where("uploadDetails.uploadId='$query'");
            $result = $this->tableGWay->selectWith($select);
            $data=array();
            foreach($result as $rSet) {
                     $data[]=array(
                            'uploadId' => $rSet->uploadId,
                            'UID' => $rSet->UID,
                            'uploadTitle' => $rSet->uploadTitle,
                            'uploadDescription' => $rSet->uploadDescription,
                            'uploadPath' => $rSet->uploadPath,
                            'uploadType' => $rSet->uploadType,
                            'albumcolor' => $rSet->albumcolor,
                            'AID' => $rSet->AID,
                            'FID' => $rSet->FID,
                            'PID' => $rSet->PID,
                            'TimeStamp' => $rSet->TimeStamp,
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
                            'uniqueUser' => $rSet->uniqueUser
                     );
           }

           return $data;
        }
    }
?>
