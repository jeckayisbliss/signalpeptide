<?php
ini_set('memory_limit', -1);

require_once("uploadFileHandler.php");
require_once("proteinUpdateHandler.php");


if (isset($_POST["file"])) {
	$upload_file_handler = new UploadFileHandler();

	$file = $upload_file_handler->getFileUrl($_POST["file"]);
	$protein_update_handler = new ProteinUpdateHandler();
	$result = $protein_update_handler->install($file);

	$response = array("message" => "Success", "result" => $result);
	echo json_encode($response);
} else {
	$response = array("message" => "'file' parameter not found.");
}

?>
