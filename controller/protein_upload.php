<?php
ini_set('memory_limit', -1);

require_once("uploadFileHandler.php");
require_once("proteinUpdateHandler.php");

$upload_file_handler = new UploadFileHandler();
if ($upload_file_handler->process()) {
 	$protein_update_handler = new ProteinUpdateHandler();
 	$file = $upload_file_handler->getUploadedFileUrl();
  	$result = $protein_update_handler->check($file);
  	$response = array("message" => "Success", "file" => $upload_file_handler->getUploadedFileName(), "result" => $result);
  	echo json_encode($response);
} else {
	$response = array("message" => "Failed");
  	echo json_encode($response);
}

?>
