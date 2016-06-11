<?php



include '../lib/PDO_connect.php';
 



$detailView = new DetailView($db, $_REQUEST['recordid']); //$db object form included file
echo $detailView->createTable();



class DetailView {

	protected $db;
	protected $recordid;

	public function __construct($db, $recordid) {
		$this->db = $db;
		$this->recordid = $recordid;
	}


	public function getRecordInfo() {

		$query_str = "SELECT * FROM sp_protein WHERE id = ".$this->recordid;

		$query = $this->db->prepare( $query_str );
		$query->execute();
		// $data = $query->fetchAll();
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return $data;
	}


	public function createTable() {

		$data = $this->getRecordInfo();

		/*UNCOMMENT ME TO SHOW DATA ARRAY*/
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		/*UNCOMMENT ME TO SHOW DATA ARRAY*/

		$str = "<table>";

		$str .= "<table>";
		$str .= "<tr bgcolor='#99CCFF' valign='top'><td><b>Names and Origin</b></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Protein Name</td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 90px' valign='top'>Recommended Name</td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 90px' valign='top'>Alternative Name</td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Organism</td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Taxonomic Lineage</td><td style='padding:5px 0px 0px 200px'><font color='navy'>{$data['taxonomic_lineage']}</font></td></tr>";
		$str .= "</table>";



		$str .= "<table>";
		$str .= "<tr bgcolor='#99CCFF' valign='top'><td><b>Protein Attributes</b></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Sequence Length</td><td style='padding:5px 0px 0px 280px'><font color='navy'>{$data['sequence_length']}</font></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Protein Existence</td><td style='padding:5px 0px 0px 280px'><font color='navy'>{$data['protein_existence']}</font></td></tr>";
		$str .= "</table>";



		$str .= "<table>";
		$str .= "<tr bgcolor='#99CCFF' valign='top' cellspacing='20px'><td><b>General Annotation</b></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Function</td><td style='padding:5px 0px 0px 200px'><font color='navy'>#</font></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>SubUnit</td><td style='padding:5px 0px 0px 200px'><font color='navy'>#</font></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Subcellular Location</td><td style='padding:5px 0px 0px 200px'><font color='navy'>{$data['subcellular_location']}</font></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Post-translational Modification</td><td style='padding:5px 0px 0px 200px'><font color='navy'>#</font></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Polymorphism</td><td style='padding:5px 0px 0px 200px'><font color='navy'>#</font></td></tr>";
		$str .= "<tr><td style='padding:5px 0px 0px 30px' valign='top'>Sequence Similarities</td><td style='padding:5px 0px 0px 200px'><font color='navy'>#</font></td></tr>";
		$str .= "</table>";



		$str .= "<table>";
		$str .= "<tr bgcolor='#99CCFF'><td><b>References</b></td></tr>";
		$str .= "</table>";


		$str .= "<table>";
		$str .= "<tr bgcolor='#99CCFF'><td><b>Sequences</b></td></tr>";
		$str .= "<tr><td><font color='navy'>{$data['sequence']}</font></td></tr>";
		$str .= "<table>";

		/*
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		$str .= "<tr><td>{$data['entry_ID']} ({$data['entry_name']})</td><td>jowiiiiii</td></tr>";
		*/


		$str .= "</table>";


		return $str;
	}
}

?>