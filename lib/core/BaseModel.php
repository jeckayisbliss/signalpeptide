<?php

ini_set('memory_limit', -1);
ini_set('max_execution_time', 0);

abstract class BaseModel implements BaseModelInterface {

	protected $tableName;
	protected $dbConn;

	private $config = array(
		'host'		=> 'localhost',
		'username'	=> 'root',
		'password'	=> '',
		'dbname'	=> 'signalpeptide'
	);

	public function __construct() {
		$this->dbConn = new PDO('mysql:host='.$this->config['host'].';dbname='.$this->config['dbname'],
								$this->config['username'],
								$this->config['password']);
		$this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                    $where.= " AND ";
                }
            }
        }

        $query = "SELECT count(*) FROM `".$this->tableName."` $where   ";

        $statement = $this->dbConn->prepare($query);
        $statement->execute();

        return $statement->fetch();
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
                        $where.= " AND ";
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

        $statement = $this->dbConn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;
    }
}

interface BaseModelInterface {
	public function save();
	public function delete();
	public function update();
	public function findBy($condtion = null, $limit = 10, $offset = 0);
}

?>
