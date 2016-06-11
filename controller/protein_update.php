<?php 

require_once("proteinUpdateHandler.php");

function echoResponse($message, $result = null, $file = null) {
	if ($result == null) {
		$result = array("new" => array(), "updates" => array());
	}
	$response = array("message" => $message, "result" => $result);
	if ($file != null) {
		$response["file"] = $file;
	}
	echo json_encode($response);
}

if (isset($_POST["action"])) {
	$action = $_POST["action"];
	if (strtolower($action) == "install") {
		if (isset($_POST["file"])) {
			$protein_update_handler = new ProteinUpdateHandler();
			$file_url = $protein_update_handler->getUpdateUrlWithFile($_POST["file"]);
			$result = $protein_update_handler->install($file_url);
			echoResponse("Success", $result);
		} else {
			echoResponse("'file' parameter is missing.", null, null);
		}
	} else if (strtolower($action) == "check") {
		if (isset($_POST["update_url"])) {
			$update_url = $_POST["update_url"];
			$protein_update_handler = new ProteinUpdateHandler();
			$result = $protein_update_handler->check($update_url);
			if (empty($protein_update_handler->getLocalUpdateFile())) {
				echoResponse("Success", $result, null);
			} else {
				echoResponse("Success", $result, $protein_update_handler->getLocalUpdateFile());
			}
		} else {
			echoResponse("'update_url' parameter is missing.", null, null);
		}
	}
} else {
	echoResponse("'action' parameter is missing.", null, null);
}

?>
