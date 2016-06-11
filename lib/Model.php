<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author stackslabs
 */
 
 require_once('DB.php');
 require_once('ModelInterface.php');


abstract class Model implements ModelInterface {

    public $tableName;
    public $dbConn;

    public function __construct() {
        $this->dbConn = DB::Open();
    }
    
    public function findBy($condition = null, $limit = 10, $offset = 0) {

        if (!is_string($condition)) {

            $where = "";
            $ctr = 0;

            if ($condition != null) {
                foreach ($condition as $key => $value) {
                    if ($ctr == 0) {
                        $where .= " WHERE ";
                    }
                    $where .= $key . " = '" . $value . "' ";
                    $ctr++;
                    if ($ctr != count($condition)) {
                        $where.= " and ";
                    }
                }
            }

            $else = "";

            if ($limit != null) {
                $else = " LIMIT $limit OFFSET $offset ";
            }

            $query = "SELECT * FROM `" . $this->tableName . "` $where  $else ";
        } else {

            $query = "SELECT * FROM `" . $this->tableName . "` $condition ";
        }

        return $this->dbConn->qry($query);
    }

    public function count($condition = null) {

        $where = "";
        $ctr = 0;
        if ($condition != null) {
            foreach ($condition as $key => $value) {
                if ($ctr == 0) {
                    $where .= " WHERE ";
                }
                $where .= $key . " = '" . $value . "' ";
                $ctr++;
                if ($ctr != count($condition)) {
                    $where.= " and ";
                }
            }
        }

//            $else = "";
//
//            if($limit != null){
//                  $else = " LIMIT $limit OFFSET $offset ";
//
//            }

        $query = "SELECT count(*) FROM `" . $this->tableName  . "` $where   ";

        return $this->dbConn->qry($query, 3);
    }

}

?>
