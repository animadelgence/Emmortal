<?php
	namespace Profile\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class uploadDetailsTable
    {
        protected $tableGateWay;
        public function __construct(TableGateway $tableGateway)
        {
            $this->tableGWay = $tableGateway;
        }
        public function fetchall($query=null)
        {

            $resultSet = $this->tableGWay->select($query);
            $array = array();
            foreach ($resultSet as $rSet) {
                if($rSet->sizeX=="H")
                    $sizeX = 2;
                else
                    $sizeX = 1;
                 if($rSet->sizeY=="W")
                    $sizeY = 1;
                else
                    $sizeY = 2;
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
        }

        public function fetchAllData($offsetvalues) {
        $sql = new Sql($this->tableGWay->adapter);
        $select = $sql->select();
        $select->from($this->tableGWay->getTable());

        if (!empty($offsetvalues)) {
            $select->limit(15)
                    ->offset($offsetvalues);
            $result = $this->tableGWay->selectWith($select);
        }
        $array = array();
        foreach ($result as $rSet) {
             if($rSet->sizeX=="H")
                    $sizeX = 2;
                else
                    $sizeX = 1;
                 if($rSet->sizeY=="W")
                    $sizeY = 1;
                else
                    $sizeY = 2;
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
