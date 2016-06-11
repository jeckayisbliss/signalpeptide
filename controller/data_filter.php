<?php

require_once("../model/SPProteinModel.php");
require_once("redundancyCheckHandler.php");

class DataFilter {

	public function process($query_signal, $query_taxonomy, $query_protein_type, $query_membrane_type, $query_nonmembrane_type, $query_evidence, $limit, $offset) {
		if ($query_signal === "Yes") {
			$is_signal = "(is_signal = '1')";
		} else {
			$is_signal = "(is_signal = '0')";
		}

		$taxonomic_lineage = "";
		if ($query_taxonomy === "Others") {
			$taxonomic_lineage = "(taxonomic_lineage != 'Archaea' OR taxonomic_lineage != 'Bacteria' OR taxonomic_lineage != 'Eukaryota' OR taxonomic_lineage != 'Viruses')";
		} else if ($query_taxonomy === "Archaea" || $query_taxonomy === "Bacteria" || $query_taxonomy === "Eukaryota" || $query_taxonomy === "Viruses") {
			$taxonomic_lineage = "(taxonomic_lineage='$query_taxonomy')";
		}

		$protein_type = "";
		if ($query_protein_type === "Membrane") {
			$protein_type = "(profile_type = 'Transmembrane')";
		} else if ($query_protein_type === "Secreted") {
			$protein_type = "(profile_type = 'Globular')";
		}

		$membrane_type = "";
		if ($query_membrane_type === "Single-pass") {
			$membrane_type = "(segment_type = 'Single-pass membrane')";
		} else if ($query_membrane_type === "Multi-pass") {
			$membrane_type = "(segment_type = 'Multi-pass membrane')";
		} else if ($query_membrane_type === "Beta-barrel") {
			$membrane_type = "(segment_type = 'Beta-barrel membrane')";
		}

		$nonmembrane_type = "";
		if ($query_nonmembrane_type === "Secretory") {
			$nonmembrane_type = "(subcellular_location LIKE '%Secreted%')";
		} else if ($query_nonmembrane_type === "Non-secretory") {
			$nonmembrane_type = "(subcellular_location NOT LIKE '%Secreted%')";
		}

		$evidence = "";
		if ($query_evidence === "Qualified") {
			$evidence = "(protein_existence = 'Evidence at protein level')";
		} else if ($query_evidence === "Non-experimental") {
			$evidence = "(protein_existence = 'Evidence at transcript level' OR protein_existence = 'Inferred from homology' OR protein_existence = 'Predicted' OR protein_existence = 'Uncertain')";
		}

		$protein = new SPProteinModel();

		$query = "WHERE $is_signal";
		if (!empty($taxonomic_lineage)) {
			$query .= " AND $taxonomic_lineage";
		}
		if (!empty($protein_type)) {
			$query .= " AND $protein_type";

			if (!empty($membrane_type) && $query_protein_type === "Membrane") {
				$query .= " AND $membrane_type";
			}
			if (!empty($nonmembrane_type) && $query_protein_type === "Secreted") {
				$query .= " AND $nonmembrane_type";
			}
		}
		if (!empty($evidence)) {
			$query .= " AND $evidence";
		}

		$result = $protein->findBy($query);
		return $result;
	}
}

$query_signal = $_GET["peptide"];
$query_taxonomy = $_GET["taxonomic_lineage"];
$query_protein_type = $_GET["protein_type"];
$query_membrane_type = $_GET["membrane_type"];
$query_nonmembrane_type = $_GET["nonmembrane_type"];
$query_evidence = $_GET["evidence"];
$limit = 10;
$offset = 0;
$percentage = $_GET["percentage"];

if (isset($_GET["limit"])) {
	$limit = $_GET["limit"];
}

if (isset($_GET["offset"])) {
	$offset = $_GET["offset"];
	$offset = $offset * $limit;
}

$data_filter = new DataFilter();

$results = $data_filter->process($query_signal, $query_taxonomy, $query_protein_type, $query_membrane_type, $query_nonmembrane_type, $query_evidence, $limit, $offset);

if ($percentage == "None") {
	$response = array();
	$response["message"] = "Success";
	$response["result"] = $results;
	echo json_encode($response);
} else {
	$percentage = $percentage / 100;
	$data = json_decode(json_encode($results), true);
	$checker = new RedundancyChecker($percentage, $data);
	$results = $checker->start();
	$response = array();
	$response["message"] = "Success";
	$response["result"] = $results;
	echo json_encode($response);
}

?>
