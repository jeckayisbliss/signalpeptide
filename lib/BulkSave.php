<?php

class BulkSave {

  protected $db;
  protected $bulkData = array();

  private $tableName = 'sp_protein';
  private $dbColumns = array(
    'entry_ID',
    'entry_name',
    'sequence',
    'subcellular_location',
    'profile_type',
    'segment_type',
    'sequence_length',
    'taxonomic_lineage',
    'function',
    'topology_orientation',
    'topology_length',
    'date_created',
    'date_last_modified',
    'fasta',
    'protein_existence',
    'is_signal',
    'signal_length'
  );

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

  public function initData($data) {
      $this->bulkData = $data; //TODO : remove the [0] agffter testing
   //array_push($this->bulkData,$data[0]);
    //array_push($this->bulkData,$data[1]);
    //array_push($this->bulkData,$data[2]);
  //  array_push($this->bulkData,$data[0], $data[1], $data[2]);

    //  print_r($this->bulkData);
  }

  public function placeholders($text, $count=0, $separator=","){
      $result = array();
      if($count > 0){
          for($x=0; $x<$count; $x++){
              $result[] = $text;
          }
      }
      return implode($separator, $result);
  }

  public function executeQuery() {


  $insert_values = array();


    $this->dbConn->beginTransaction();
   foreach($this->bulkData as $d){
      $question_marks[] = '('  . $this->placeholders('?', sizeof($d)) . ')';
      $insert_values = array_merge($insert_values, array_values($d));
    }

    //
    //print_r($this->bulkData);
    // print_r($insert_values);

    $str = "INSERT INTO {$this->tableName} (" . implode(",", $this->dbColumns ) . ") VALUES " . implode(',', $question_marks);
    $stmt = $this->dbConn->prepare($str);


    try {
        $stmt->execute($insert_values);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
  return $this->dbConn->commit();

   //return $str;
 }


}


 ?>
