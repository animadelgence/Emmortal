<?php
	namespace Backend\Model;
    use Zend\Db\TableGateway\TableGateway;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Sql\Sql;
    class seoTable
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
                $array[] = array(
                    'seoid' => $rSet->seoid,
                    'seopagetitle' => $rSet->seopagetitle,
                    'seometadescription' => $rSet->seometadescription,
                    'seoOGimagepath'=>$rSet->seoOGimagepath,
                    'seoFaviconimagepath' => $rSet->seoFaviconimagepath,
                    'creationDate' => $rSet->creationDate
                    //'bgimage' => $rSet->bgimage
                    );
            }
            return $array;
        }

        public function insertdata($data)
        {
            return $rowset = $this->tableGWay->insert($data);
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

    }
?>
