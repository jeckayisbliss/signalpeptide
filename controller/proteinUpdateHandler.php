<?php

require_once ('../model/SPProteinModel.php');
require_once ('UniProtParser.php');
require_once ('../lib/BulkSave.php');

class ProteinUpdateHandler {

	protected $update_url;
	protected $protein_updates;
	protected $update_relative_dir;
	protected $update_dir;
	protected $update_local_file;

	protected $bulkSave;

	public function __construct() {
		$this->update_url = "";
		$this->protein_updates = array();
		$this->update_relative_dir = "/signal-peptide/update/";
		$this->update_dir = $_SERVER["DOCUMENT_ROOT"].$this->update_relative_dir;
		$this->update_local_file = "";

		$this->bulkSave  = new BulkSave();
	}

	public function check($update_url) {
		$this->update_url = $update_url;
		$callback = function($data) {
			if (empty($data))  {
				return;
			}
			$this->saveToUpdateDirectory($data);
		};
		$this->prepareUpdates($callback);
		return $this->save(false);
	}

	public function install($update_url) {
		$this->update_url = $update_url;
	 	//$this->prepareUpdates();
   		///return $this->save(true)

		$this->bulkSave->initData( $this->prepareUpdates() ) ;
		return $this->bulkSave->executeQuery();
	}

	public function getLocalUpdateFile() {
		return $this->update_local_file;
	}

	public function getUpdateUrlWithFile($file) {
		return $_SERVER["HTTP_HOST"].$this->update_relative_dir.$file;
	}

	private function saveToUpdateDirectory($data) {
		if (!empty($data)) {
			$this->update_local_file = time()."_update.txt";
			$file = $this->update_dir.$this->update_local_file;
			return file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
		}
		return true;
	}

	private function prepareUpdates($callback = null) {
		$result = parseUniProtData(getUpdateData($this->update_url), $callback);
		foreach ($result as $key => $value) {
			$protein = new SPProteinModel();
			$protein->values($value);
			$this->protein_updates[] = $protein;
		}
		return $result;
	}

		private function save($shouldSaveToDB) {



			$info = array("new" => array(), "updates" => array());
			if (count($this->protein_updates) > 0) {
				$updated = array();
				$new = array();

				// foreach ($this->protein_updates as $protein_update) {
				// 	error_reporting(0);
				// 	echo "<pre>";
				// 	print_r($protein_update->save());
				// 	echo "</pre>";
				// 	break;
				// }

				//TODO :: investigate why data is not saving
				//FIXME :: data is not saved


				foreach ($this->protein_updates as $key => $protein_update) {

					$results = $protein_update->findBy(array("entry_name" => $protein_update->entryName), null, null);

					if (count($results) == 0) {
						if ($shouldSaveToDB) {
							$protein_update->save(); //acutal save of protein @ /controller/SPProteinModel.php -- using the "public function save()"
						}
						$new[] = $protein_update;
					}
					 else {
						$result = $results[0];
						if ($result->dateLastModified != $protein_update->dateLastModified) {
							if ($shouldSaveToDB) {
								$protein_update->id($result->id);
								$protein_update->update();
							}
							$updated[] = $protein_update;
						}
					} //end else
				} // end foreach

				$info["new"] = $new;
				$info["updates"] = $updated;
			}

			return $info;
		}
}

?>
