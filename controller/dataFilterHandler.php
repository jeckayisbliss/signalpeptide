<?php
	session_start();
	error_reporting(E_ALL);
	 
 
	if(!isset($_SESSION['peptide']) && !isset($_SESSION['proteinType']) && !isset($_SESSION['evidenceLevel']) && !isset($_SESSION['taxonomy'])){
		// set post into session
		$_SESSION['peptide'] = $_POST['peptide'];
		$_SESSION['proteinType'] = $_POST['proteinType'];
		$_SESSION['evidenceLevel'] = $_POST['evidenceLevel'];
		$_SESSION['taxonomy'] = $_POST["taxonomy"];
 
		$peptide = $_SESSION['peptide'];
		$proteinType = $_SESSION['proteinType'];
		$evidenceLevel = $_SESSION['evidenceLevel'];
		$taxonomy = $_SESSION["taxonomy"];
	}
 
		$peptide = $_SESSION['peptide'];
		$proteinType = $_SESSION['proteinType'];
		$evidenceLevel = $_SESSION['evidenceLevel'];
		$taxonomy = $_SESSION["taxonomy"];
 
 
		$filter_arr = array(
						"signal_peptide" => $peptide,
						"protein_type" => $proteinType,
						"evidence_level" => $evidenceLevel,
						"taxonomic_lineage" => $taxonomy
					);
 
 
		$dataFilter = new DataFilter( $filter_arr );
 
		$_SESSION['filter'] = $_GET['filter'];
		


	class DataFilter{
 
		protected $filter_arr = array();
 
		public function __construct( $filter_arr ){
			$this->filter_arr = $filter_arr;
		}
 
 
		public function fetchData(){
			include 'lib/PDO_connect.php';
 	 
			// $query_str = "SELECT * FROM sp_protein".$this->buildFilter();
			$query_str = "SELECT * FROM sp_protein WHERE taxonomic_lineage like '%Viruses%'";
			echo $query_str;
			$query = $db->prepare( $query_str );
			$query->execute();
			$rows = $query->fetchAll();
 
			return $rows;
		}
 
		public function buildFilter() {

			$str = " WHERE";

			unset($this->filter_arr["signal_peptide"]);

			// modify filter to truthy show all records
			foreach ($this->filter_arr as $colummname => $value) {
				if( in_array( trim(strtolower($value)) , array('none', 'all')) )
					unset($this->filter_arr[$colummname]);
			}
 
			$filter_cnt = count( $this->filter_arr );
			$cnt = 1;

 
			foreach ($this->filter_arr as $colummname => $value) {

				$str .= " $colummname like '%$value%'";

 
				if( $cnt < $filter_cnt )
						$str .= " AND ";
 
				$cnt++;
			}

			if( empty($this->filter_arr) )
				return '';

			return $str;
		}
}
?>