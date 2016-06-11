<?php
	class RedundancyChecker {
		
		protected $project_dir;
		protected $input_dir;
		protected $output_dir;
		protected $redundancy_script;
		protected $perl_bin;

		protected $max_percentage;
		protected $data;

		protected $redundancy_checker_dir;

		public function __construct($max_percentage, $data) {
			$this->max_percentage = $max_percentage;
			$this->data = $data;

			$this->project_dir = $_SERVER['DOCUMENT_ROOT'].'/signal-peptide';
			$this->redundancy_checker_dir = $this->project_dir.'/lib/redundancy-checker';
			$this->input_dir = $this->redundancy_checker_dir.'/input';
			$this->output_dir = $this->redundancy_checker_dir.'/output';
			$this->redundancy_script = $this->redundancy_checker_dir.'/source/do.pl';
			$this->perl_bin = $this->redundancy_checker_dir.'/source/perl/bin/perl';
		}

		public function start() {
			if (count($this->data) == 0) {
				return null;
			}

			$fasta = $this->createFastaString();

			$input_file_path = $this->createFastaFile($fasta);
			$input_file_name = pathinfo($input_file_path, PATHINFO_FILENAME);
			$input_file_basename = basename($input_file_path);
			$entry_id = $input_file_name;
			$entry_dir = $this->output_dir.'/'.$entry_id;
			$entry_temp_dir = $entry_dir.'/tmp';
			$output_file_path = $entry_dir.'/'.$input_file_name.'.fasta';
			$align_file_path = $entry_dir.'/'.$input_file_name.'.align';

			$cull_file_path = $entry_dir."/cullseq_pc$this->max_percentage"."_chains";
			$cull_log_file_path = $entry_dir."/log_pc$this->max_percentage.log";

			// Write the contents to the file, 
			// using the FILE_APPEND flag to append the content to the end of the file
			// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
			file_put_contents($input_file_path, $fasta, FILE_APPEND | LOCK_EX);

			$this->createDir($this->output_dir);
			$this->createDir($entry_dir);
			$this->createDir($entry_temp_dir);

			$result = array();
			exec("$this->perl_bin $this->redundancy_script".
				" ".EscapeShellArg($input_file_path).
				" ".EscapeShellArg($output_file_path).
				" ".EscapeShellArg($entry_temp_dir).
				" ".EscapeShellArg($input_file_basename).
				" ".EscapeShellArg($align_file_path).
				" ".EscapeShellArg($entry_dir).
				" ".EscapeShellArg($this->max_percentage).
				" ".EscapeShellArg($cull_file_path).
				" ".EscapeShellArg($cull_log_file_path), $result);
			$result = implode("\n", $result);
			$content = $this->getFileContent($cull_file_path);
			$entry_ids = $this->getOnlyEntryIDs($content);
			$culled_rows = $this->cullRows($entry_ids);
			return $culled_rows;
		}

		private function createFastaString() {
			$fasta = "";
			foreach ($this->data as $key) { 
				$fasta .= $key['fasta']."\r\n";
			}
			return $fasta;
		}

		private function createFastaFile($fasta) {
			$input_file_path = $this->input_dir.'/'.$this->generateFastaFileName();
			return $input_file_path;
		}

		private function generateFastaFileName() {
			return ''.time().'.txt';
		}

		private function createDir($dir) {
			if (!is_dir($dir)) {
				mkdir($dir);
			}
		}

		private function getFileContent($file) {
			$content = file_get_contents($file, FILE_USE_INCLUDE_PATH);
			return $content;
		}

		private function getOnlyEntryIDs($content) {
			$entry_ids = array();
			$lines = explode("\n", $content);
			foreach ($lines as $line) {
				$strings = explode("|", $line);
				
				if (count($strings) < 2) continue;

				$entry_ids[] = $strings[1];
			}
			return $entry_ids;
		}

		private function cullRows($entry_ids) {
			if (count($this->data) == 0 || count($entry_ids) == 0) return $this->data;
			return $this->prioritizeCulledRowsOnResult($entry_ids);
		}

		private function prioritizeCulledRowsOnData($entry_ids) {
			$e_ids = $entry_ids;
			$culled_rows = array();

			foreach ($this->data as $key) {
				if (count($e_ids) == 0) break;
				$row_entry_id = $key['entryId'];
				for ($i = 0; $i < count($e_ids); $i++) {
					$e_id = $e_ids[$i];
					if ($row_entry_id === $e_id) {
						$culled_rows[] = $key;
						unset($e_ids[$i]);
						$e_ids = array_values($e_ids);
						break;
					}
				}
			}

			return $culled_rows;
		}

		private function prioritizeCulledRowsOnResult($entry_ids) {
			$e_ids = $entry_ids;
			$culled_rows = array();

			for ($i = 0; $i < count($e_ids); $i++) {
				$e_id = $e_ids[$i];
				foreach ($this->data as $key) {
					$row_entry_id = $key['entryId'];
					if ($row_entry_id === $e_id) {
						$culled_rows[] = $key;
						break;
					}
				}
			}

			return $culled_rows;
		}
	}
?>
