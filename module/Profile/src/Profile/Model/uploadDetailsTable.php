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
                    'filestatus' => $rSet->filestatus,
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

        public function fetchAllData($offsetvalues) {
        $sql = new Sql($this->tableGWay->adapter);
        $select = $sql->select();
        $select->from($this->tableGWay->getTable());
        $select->order('uploadId DESC');

        if (!empty($offsetvalues)) {
            $select->limit(15)
                    ->offset($offsetvalues);
            $result = $this->tableGWay->selectWith($select);
        }
        $array = array();
        foreach ($result as $rSet) {
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
                    'filestatus' => $rSet->filestatus,
                    'sizeX' => $sizeX,
                    'sizeY' => $sizeY,
                    'AID' => $rSet->AID,
                    'FID' => $rSet->FID,
                    'PID' => $rSet->PID,
                    'TimeStamp' => $rSet->TimeStamp
                    );
        }
        return $array;
        //print_r($array);exit;
    }

        public function insertData($data)
        {
            return $rowset = $this->tableGWay->insert($data);
        }
        public function updateData($data,$where)
        {
            //$rowset = $this->tableGWay->select($where);
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
                            'activation' => $rSet->activation
                     );
           }

           return $data;
        }
    }
?>
