<?php

class UploadFileHandler {

	private $upload_dir;
	private $uploaded_filename;
	private $upload_relative_dir;

	public function __construct() {
		$this->upload_relative_dir = "/signal-peptide/upload/";
		$this->upload_dir = $_SERVER["DOCUMENT_ROOT"].$this->upload_relative_dir;
		$this->createDir($this->upload_dir);
	}

	private function createDir($dir) {
		if (!is_dir($dir)) {
			mkdir($dir);
		}
	}

	public function process() {
		if (!$this->checkFileError()) {
			if (!$this->checkFileExistence()) {
				$this->uploaded_filename = time()."_".$_FILES["file"]["name"];
				$filepath = $this->upload_dir.$this->uploaded_filename;
				return move_uploaded_file($_FILES["file"]["tmp_name"],
				$filepath);
			}
		}

		return false;
	}

	public function getUploadedFileUrl() {
		// echo $this->uploaded_filename;
		return $this->getFileUrl($this->uploaded_filename);
	}

	public function getUploadedFileName() {
		return $this->uploaded_filename;
	}

	public function getFileUrl($file) {
		return $_SERVER["HTTP_HOST"].$this->upload_relative_dir.$file;
	}

	private function checkFileError() {
		return ($_FILES["file"]["error"] > 0);
	}

	private function checkFileExistence() {
		return file_exists($this->upload_dir.$_FILES["file"]["name"]);
	}
}

?>
