<?php

require_once("../model/SPProteinModel.php");

$update_url = "http://www.uniprot.org/uniprot/?query=&limit=10&format=txt";

$webdata = get_data($update_url);
$webdata = explode("\n", $webdata);
$signal = false;
$entryName = "";
$seqLength = "";
$sqFound = false;

foreach($webdata as $block) {
	$data = explode("   ", $block);
	foreach($data as $val) {
		$trimmed_val = trim($val);
		if ($trimmed_val === "//") {
			$sg = $signal ? 1 : 0;
			echo "<br>entryName=$entryName, seqLength=$seqLength, signal=$sg";
			$entryName = "";
			$seqLength = "";
			$signal = false;
			$sqFound = false;
		} else {
			if ($val != "ID" && $data[0] == "ID") {
				// echo $data[1];
				$entryName = $data[1];
			}

			if (($val != "ID" && $val != "Reviewed;" ) && $entryName != null && $data[0] == "ID") {				
				$seqLength = str_replace(".", "", $data[count($data) - 2 ]." ".$data[count($data) - 1]);
			}

			if ($val != "FT" && $data[0] == "FT") {
				if (count($data) > 0) {
					$ft = $data[1];
					$ft = strtolower($ft);
					if ($ft == "signal") {
						$signal = true;
					}
				}
			}
		}
	}

	if ($data[0] == "SQ") {
		$sqFound = true;
	}
}

/* gets the data from a URL */
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$data = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo $http_code;
	curl_close($ch);
	if ($http_code == 200) {
		return $data;
	} else {
		return "";
	}
}

// $proteinModel = new SPProteinModel();
// $proteinModel->id = "1";
// $proteinModel->isSignal = true;
// $proteinModel->update();

?>