<?php
header("Content-Type:text/plain");

class UniProtParser {

	private $protein_data;

	public function __construct($protein_data) {
		$this->protein_data = $protein_data;
	}

	public function getID() {
		$key_pos = strpos($this->protein_data, "AC   ");
		$semi_colon_pos = strpos($this->protein_data, ";", $key_pos);
		$start_pos = $key_pos + 5;
		$end_pos = $semi_colon_pos - $key_pos - 5;
		$entryID = substr($this->protein_data, $start_pos, $end_pos);
		return $entryID;
	}

	public function getName() {
		$key_pos = strpos($this->protein_data, "ID   ");
		$new_line_pos = strpos($this->protein_data, "\n", $key_pos);
		$start_pos = $key_pos + 5;
		$end_pos = $new_line_pos - $key_pos - 5;
		$substring = substr($this->protein_data, $start_pos, $end_pos);
		$exploded = explode(" ", $substring);
		if (count($exploded) > 0) {
			return $exploded[0];
		} else {
			return "";
		}
	}

	public function getSequence() {
		$key_pos = strpos($this->protein_data, "SQ   ");
		$new_line_pos = strpos($this->protein_data, "\n", $key_pos);
		$max_length = strlen($this->protein_data);
		$start_pos = $new_line_pos + 1;
		$end_pos = $max_length - $start_pos;
		$sequence = substr($this->protein_data, $start_pos, $end_pos);
		$sequence = trim($sequence);
		$sequence = str_replace("\r\n     ", "\n", $sequence);
		$exploded = explode(" ", $sequence);
		$exploded = array_filter($exploded);
		$sequence = implode(" ", $exploded);

		return $sequence;
	}

	public function getSegmentType() {
		// $types = ["profile_type" => "", "segment_type" => ""];
		// $substring = $subcellular_location;

		// if (strpos($substring, "Single-pass type I") !== false) {
		// 	$types["profile_type"] = "Transmembrane";
		// 	$types["segment_type"] = "Single-pass membrane";
 	// 	} else if (strpos($substring, "Single-pass type II") !== false) {
		// 	$types["profile_type"] = "Transmembrane";
		// 	$types["segment_type"] = "Single-pass membrane";
		// } else if (strpos($substring, "Single-pass type III") !== false) {
		// 	$types["profile_type"] = "Transmembrane";
		// 	$types["segment_type"] = "Single-pass membrane";
		// } else if (strpos($substring, "Single-pass type IV") !== false) {
		// 	$types["profile_type"] = "Transmembrane";
		// 	$types["segment_type"] = "Single-pass membrane";
		// } else if (strpos($substring, "Single-pass membrane") !== false) {
		// 	$types["profile_type"] = "Transmembrane";
		// 	$types["segment_type"] = "Single-pass membrane";
		// } else if (strpos($substring, "Multi-pass membrane") !== false) {
		// 	$types["profile_type"] = "Transmembrane";
		// 	//$types["segment_type"] = "Multi-pass membrane";

		// 	//here

		// } else if (strpos($substring, "Single-pass type I") == false &&	(strpos($this->protein_data, "FT   TRANSMEM") == false)) {
		// 	$types["profile_type"] = "Globular";
		// } else if (strpos($substring, "Single-pass type II") == false && (strpos($this->protein_data, "FT   TRANSMEM") == false)) {
		// 	$types["profile_type"] = "Globular";
		// } else if (strpos($substring, "Single-pass type III") == false && (strpos($this->protein_data, "FT   TRANSMEM") == false)) {
		// 	$types["profile_type"] = "Globular";
		// } else if (strpos($substring, "Single-pass type IV") == false && (strpos($this->protein_data, "FT   TRANSMEM") == false)) {
		// 	$types["profile_type"] = "Globular";
		// } else if (strpos($substring, "Single-pass membrane") == false && (strpos($this->protein_data, "FT   TRANSMEM") == false)) {
		// 	$types["profile_type"] = "Globular";
		// } else if (strpos($substring, "Multi-pass membrane") == false ) {
		// 	$types["profile_type"] = "Globular";

		// } else {
		/*	$key = "CC   -!- DOMAIN: Beta-barrel";
			$key_pos = strpos($this->protein_data, $key);
			if ($key_pos !== false) {
				$types["profile_type"] = "Globular";
				$types["segment_type"] = "Beta-barrel membrane";
			}*/

			$key = "FT   TRANSMEM";
			$key_pos = strpos($this->protein_data, $key);

			if(count($key_pos) == 1) {
				//$types["profile_type"] = "Transmembrane";
				return $segment_type = "Single-pass membrane";
			} else if(count($key_pos) > 1) {
				//$types["profile_type"] = "Transmembrane";
				return $segment_type = "Multi-pass membrane";
			} else if(count($key_pos) == 0) {
				//$types["profile_type"] = "Transmembrane";
				return $segment_type = "Beta-barrel membrane";
			}
		//}

		return $types;
	}

	public function getProfileType($keyword) {
		$kw = $keyword;

		if (strpos($kw, "Transmembrane") !== false) {
			return "Transmembrane";
 		} else {
			return "Globular";
 		}

	}

	public function getKeyword() {
		$key = "KW   ";
		$key_pos = strpos($this->protein_data, $key);
		
		if ($key_pos === false) {
			return "";
		}

		$start_pos = $key_pos + strlen($key);
		$delimiter_pos = strpos($this->protein_data, "FT   ", $start_pos);		
		$end_pos = $delimiter_pos - $start_pos;
		$substringKW = substr($this->protein_data, $start_pos, $end_pos);
		$exploded = explode("KW   ", $substringKW);
		$substringKW = implode(" ", $exploded);
		$substringKW = $this->clean($substringKW);
		$substringKW = str_replace("\n", " ", $substringKW);
		$split = preg_split('/\s+/', $substringKW);
		$substringKW = implode(" ", $split);
		
		return $substringKW;
	}

	public function getSubcellularLocation() {
		$key = "CC   -!- SUBCELLULAR LOCATION:";
		$key_pos = strpos($this->protein_data, $key);
		
		if ($key_pos === false) {
			return "";
		}

		$start_pos = $key_pos + strlen($key);
		$delimiter_pos = strpos($this->protein_data, "CC   -!-", $start_pos);
		if ($delimiter_pos === false) {
			$delimiter_pos = strpos($this->protein_data, "CC   -----------------------------------------------------------------------", $start_pos);
		}
		$end_pos = $delimiter_pos - $start_pos;
		$substring = substr($this->protein_data, $start_pos, $end_pos);
		$exploded = explode("CC       ", $substring);
		$substring = implode(" ", $exploded);
		$substring = $this->clean($substring);
		$substring = str_replace("\n", " ", $substring);
		$split = preg_split('/\s+/', $substring);
		$substring = implode(" ", $split);
		return $substring;
	}

	public function getTaxonomy() {
		if (strpos($this->protein_data, "OC   Archaea")) {
			return "Archaea";
		} else if (strpos($this->protein_data, "OC   Bacteria")) {
			return "Bacteria";
		} else if (strpos($this->protein_data, "OC   Eukaryota")) {
			return "Eukaryota";
		} else if (strpos($this->protein_data, "OC   Viruses")) {
			return "Viruses";
		} else {
			return "Others";
		}
	}

	public function getFunction() {
		$key = "CC   -!- FUNCTION:";
		$key_pos = strpos($this->protein_data, $key);
		
		if ($key_pos === false) {
			return "";
		}

		$start_pos = $key_pos + strlen($key);
		$delimiter_pos = strpos($this->protein_data, "CC   -!-", $start_pos);
		if ($delimiter_pos === false) {
			$delimiter_pos = strpos($this->protein_data, "CC   -----------------------------------------------------------------------", $start_pos);
		}
		$end_pos = $delimiter_pos - $start_pos;
		$substring = substr($this->protein_data, $start_pos, $end_pos);
		$exploded = explode("CC       ", $substring);
		$substring = implode(" ", $exploded);
		$substring = $this->clean($substring);
		$substring = str_replace("\n", " ", $substring);

		return $substring;
	}
/*
	public function getNoOfSegment() {
		$key = "FT   TRANSMEM";
		$key_pos = strpos($this->protein_data, $key);
		
		$topology_length = "";

		while($key_pos !== false) {
			$new_line_pos = strpos($this->protein_data, "\n", $key_pos);
			$start_pos = $key_pos + strlen($key);
			$end_pos = $new_line_pos - $start_pos;
			$substring = substr($this->protein_data, $start_pos, $end_pos);
			$substring = $this->clean($substring);
			$exploded = explode(" ", $substring);
			$exploded = array_filter($exploded);
			$imploded = implode(" ", $exploded);
			$exploded = explode(" ", $imploded);
			
			if (count($exploded) > 1) { 
				$start = intval($exploded[0]);
				$end = intval($exploded[1]);
				$length = $end - $start + 1;
				//$length = "length($start - $end) = $length";
				
				if (!empty($topology_length)) {
					$topology_length .= ", ";
				}
				$topology_length .= $length;
			}

			$key_pos = strpos($this->protein_data, $key, $new_line_pos);
		}	
			return substr_count($topology_length, ",") + 1;
	}
*/

	public function isFTTransmem_exist() {
		$exist = "1";
		$not_exist = "0";

		if(strpos($this->protein_data, "FT   TRANSMEM") !== false) {
			return $exist;
		}
		else
			return $not_exist;
	}

	public function getTransmem($profType, $ftTransmem_exist) {
		$result = array("topology_length" => "", "topology_orientation" => "", "segment_type" => "");
		$key = "FT   TRANSMEM";
		$key_pos = strpos($this->protein_data, $key);
		
		$pType = $profType; 
		$ftTransmem = $ftTransmem_exist;

		$topology_length = "";
		$topology_orientation = "";		
		$segment_type = "";
		$count_length = "";

		while($key_pos !== false) {
			$new_line_pos = strpos($this->protein_data, "\n", $key_pos);
			$start_pos = $key_pos + strlen($key);
			$end_pos = $new_line_pos - $start_pos;
			$substring = substr($this->protein_data, $start_pos, $end_pos);
			$substring = $this->clean($substring);
			$exploded = explode(" ", $substring);
			$exploded = array_filter($exploded);
			$imploded = implode(" ", $exploded);
			$exploded = explode(" ", $imploded);

			if (count($exploded) > 1) { 
				$start = intval($exploded[0]);
				$end = intval($exploded[1]);
				$length = $end - $start + 1;
				$length = "$start - $end";

				if (!empty($topology_length)) {
					$topology_length .= ",\n";
				}
				$topology_length .= $length;
				/*
				$topo_orient = "";
				for ($i = 2; $i < count($exploded); $i++) {
					$topo_orient .= $exploded[$i];
				}

				if (!empty($topology_orientation)) {
					$topology_orientation .= ", ";
				}
				$topology_orientation .= $topo_orient;*/
			}

			$key_pos = strpos($this->protein_data, $key, $new_line_pos);
		}	

		if($pType == "Transmembrane") {

			$count_length =  substr_count($topology_length, ",") + 1;

			if ($count_length == 1 &&  $ftTransmem == "1") {
				$segment_type = "Single-pass membrane";
			} else if ($count_length > 1 &&  $ftTransmem == "1") {
				$segment_type = "Multi-pass membrane";		
			} else if ($count_length == 1 &&  $ftTransmem == "0") {
				$segment_type ="Beta-barrel membrane";
				$count_length = "";
			}

		} else
			$count_length = "";

		$result["topology_length"] =  $count_length;
		$result["topology_orientation"] = $topology_length;
		$result["segment_type"] = $segment_type;

		return $result;
	}

	public function getSequenceLength() {
		$key = "SQ   ";
		$key_pos = strpos($this->protein_data, $key);
		$semi_colon_pos = strpos($this->protein_data, ";", $key_pos);
		$start_pos = $key_pos + strlen($key);
		$end_pos = $semi_colon_pos - $start_pos;
		$substring = substr($this->protein_data, $start_pos, $end_pos);
		$exploded = explode(" ", $substring);
		if (count($exploded) > 1) {
			return $exploded[count($exploded) - 2]." ".$exploded[count($exploded) - 1];
		} else {
			return "";
		}
	}

	public function getDateCreated() {
		if(strpos($this->protein_data,"sequence version 1")) {
			return $this->getDate("/(DT).+(sequence version 1)/");
		} else {
			return $this->getDate("/(DT).+(integrated into UniProtKB)/");
		}
	}

	public function getDateLastModified() {
		return $this->getDate("/(DT).+(entry version)/");
	}

	public function getFasta($id, $name, $sequence) {
		$seq = str_replace(" ", "", $sequence);
		return ">sp|$id|$name\n$seq";
	}

	public function getProteinExistence() {
		if (strpos($this->protein_data, "PE   1:") !== false) {
			return "Evidence at protein level";
		} else if (strpos($this->protein_data, "PE   2:") !== false) {
			return "Evidence at transcript level";
		} else if (strpos($this->protein_data, "PE   3:") !== false) {
			return "Inferred from homology";
		} else if (strpos($this->protein_data, "PE   4:") !== false) {
			return "Predicted";
		} else if (strpos($this->protein_data, "PE   5:") !== false) {
			return "Uncertain";
		} else {
			return "";
		}
	}

	public function isSignal() {
		if (strpos($this->protein_data, "FT   SIGNAL") !== false) {
			return "1";
		} else {
			return "0";
		}
	}

	public function getSignalLength() {
		$key = "FT   SIGNAL";
		$key_pos = strpos($this->protein_data, $key);
		
		$signal_length = "";

		while($key_pos !== false) {
			$new_line_pos = strpos($this->protein_data, "\n", $key_pos);
			$start_pos = $key_pos + strlen($key);
			$end_pos = $new_line_pos - $start_pos;
			$substring = substr($this->protein_data, $start_pos, $end_pos);
			$substring = $this->clean($substring);
			$exploded = explode(" ", $substring);
			$exploded = array_filter($exploded);
			$imploded = implode(" ", $exploded);
			$exploded = explode(" ", $imploded);

			if (count($exploded) > 1) {
				if($exploded[0] == "<1") {
					$start = "<1";
				} else {
					$start = intval($exploded[0]);
				}

				$end = intval($exploded[1]);
				if( $end == "0") {
					$end = "?";
				}
				$signal_length = "$start - $end";
			}

			$key_pos = strpos($this->protein_data, $key, $new_line_pos);
		}

		return $signal_length;
	}

	private function clean($string) {
		$str = trim($string);
		$str = str_replace("\r\n", '', $str);
		$str = str_replace("\t\n", '', $str);
		$str = str_replace('\r', '', $str);
		$str = str_replace('\t', '', $str);

		return $str;
	}

	private function getDate($regex) {
		if (preg_match($regex, $this->protein_data, $matches, PREG_OFFSET_CAPTURE)) {
			$key = "DT   ";
			$key_pos = $matches[0][1];
			$new_line_pos = strpos($this->protein_data, "\n", $key_pos);
			$start = $key_pos + strlen($key);
			$end = $new_line_pos - $start;
			$substring = substr($this->protein_data, $start, $end);
			$exploded = explode(",", $substring);
			if (count($exploded) > 0) {
				$month_array = array("JAN"=>"01","FEB"=>"02","MAR"=>"03","APR"=>"04","MAY"=>"05","JUN"=>"06","JUL"=>"07","AUG"=>"08","SEP"=>"09","OCT"=>"10","NOV"=>"11","DEC"=>"12");
				$date = $exploded[0]; 
				$exploded = explode("-", $date);
				$month = $exploded[1]; 
				$date = str_replace($month, $month_array[$month], $date);
				return $date;
			} else {
				return "";
			}
		}
	}
}

function getSingleProteinData($data, $start_pos, &$protein_data) {
	$delimiter = "\n//";
	$delimiter_pos = strpos($data, $delimiter, $start_pos);
	if ($delimiter_pos !== false) {
		$end_pos = $delimiter_pos - $start_pos;
		$protein_data = substr($data, $start_pos, $end_pos);
		return $delimiter_pos + strlen($delimiter);
	} else {
		$protein_data = "";
		return false;
	}
}

function parseUniProtData($data, $callback) {
	$result = array();

	$start_pos = 0;
	while ($start_pos !== false) {
		$protein_data = "";
		$start_pos = getSingleProteinData($data, $start_pos, $protein_data);
		// echo "data: $protein_data\n";

		if (empty($protein_data)) {
			break;
		}

		$protein_data = trim($protein_data);
		
		$parser = new UniProtParser($protein_data);

		$id = $parser->getID();
		$name = $parser->getName();
		$seq = $parser->getSequence();
		$sub_loc = $parser->getSubcellularLocation();
		$keyword = $parser->getKeyword();
		$ftTransmem_exist = $parser->isFTTransmem_exist();
		$profile_type = $parser->getProfileType($keyword);
		//$segment_type = $parser->getSegmentType();
		//$type = $parser->getProfileAndSegmentType($sub_loc);
		//$profile_type = $type["profile_type"];
		//$segment_type = $type["segment_type"];
		//$trans_type = $type["trans_type"];
		$seq_length = $parser->getSequenceLength();
		$taxonomy = $parser->getTaxonomy();
		$functions = $parser->getFunction();		
		//$topology_length = $parser->getNoOfSegment();
		$topo = $parser->getTransmem($profile_type, $ftTransmem_exist);
		$topology_orientation = $topo["topology_orientation"];
		$topology_length = $topo["topology_length"];
		$segment_type = $topo["segment_type"];
		$date_created = $parser->getDateCreated();
		$date_last_modified = $parser->getDateLastModified();
		$fasta = $parser->getFasta($id, $name, $seq);
		$protein_existence = $parser->getProteinExistence();
		$is_signal = $parser->isSignal();
		$signal_length = $parser->getSignalLength();

		$protein = array(
			"entry_ID" => $id,
			"entry_name" => $name,
			"sequence" => $seq,
			"subcellular_location" => $sub_loc,
			"profile_type" => $profile_type,
			"segment_type" => $segment_type,
			//"trans_type" => $trans_type,
			"sequence_length" => $seq_length,
			"taxonomic_lineage" => $taxonomy,
			"function" => $functions,
			"topology_orientation" => $topology_orientation,
			"topology_length" => $topology_length,
			"date_created" => $date_created,
			"date_last_modified" => $date_last_modified,
			"fasta" => $fasta,
			"protein_existence" => $protein_existence,
			"is_signal" => $is_signal,
			"signal_length" => $signal_length
			);

		$result[] = $protein;
	}

	if ($callback !== null) {
		$callback($data);  
	}   

	return $result;
}

function getUpdateData($updateUrl) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $updateUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$data = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if ($http_code == 200) {
		return $data;
	} else {
		return "";
	}
}

// $result = parseUniProtData(getUpdateData("http://www.uniprot.org/uniprot/?query=&limit=10&format=txt"));
// echo json_encode($result);


?>