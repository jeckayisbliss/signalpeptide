<?php
ini_set('memory_limit', -1);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../lib/core/BaseModel.php');

class SPProteinModel extends BaseModel {

    public $id;

	public $entryId;
	public $entryName;
	public $sequence;
	public $profileType;
	public $segmentType;
	//public $transType;
	public $taxonomicLineage;
	public $functions;
	public $topologyOrientation;
	public $topologyLength;
	public $subcellularLocation;
	public $sequenceLength;
	public $dateCreated;
	public $dateLastModified;
	public $fasta;
	public $proteinExistence;
	public $isSignal;
	public $singalLength;

    protected $limit = null;
    protected $offset = null;

    public function __construct($tableName = null) {
        parent::__construct();
		empty($tableName) ? $this->tableName = "sp_protein" : $this->tableName = $tableName;
    }

    public function id($id = null) {
        return empty($id) ? $this->id : $this->id = $id;
    }

    public function entryId($entryId = null) {
        return empty($entryId) ? $this->entryId : $this->entryId = $entryId;
    }

	public function entryName($entryName = null){
		return empty($entryName) ? $this->entryName : $this->entryName = $entryName;
	}

	public function taxonomicLineage($taxonomicLineage = null) {
		return empty($taxonomicLineage) ? $this->taxonomicLineage : $this->taxonomicLineage = $taxonomicLineage;
	}

	public function proteinExistence($proteinExistence = null) {
		return empty($proteinExistence) ? $this->proteinExistence : $this->proteinExistence = $proteinExistence;
	}

	public function subcellularLocation($subcellularLocation = null) {
		return empty($subcellularLocation) ? $this->subcellularLocation : $this->subcellularLocation = $subcellularLocation;
	}

	public function sequence($sequence = null) {
		return empty($sequence) ? $this->sequence : $this->sequence = $sequence;
	}

	public function sequenceLength($sequenceLength = null) {
		return empty($sequenceLength) ? $this->sequenceLength : $this->sequenceLength = $sequenceLength;
	}

	public function dateCreated($dateCreated = null) {
		return empty($dateCreated) ? $this->dateCreated : $this->dateCreated = $dateCreated;
	}

	public function dateLastModified($dateLastModified = null) {
		return empty($dateLastModified) ? $this->dateLastModified : $this->dateLastModified = $dateLastModified;
	}

	public function fasta($fasta = null) {
		return empty($fasta) ? $this->fasta : $this->fasta = $fasta;
	}

	public function isSignal($isSignal = null) {
		return ($isSignal === true || $isSignal === 1 || $isSignal === "1") ? $this->isSignal = true : $this->isSignal = false;
	}

	public function proteinFunction($functions = null) {
		return empty($functions) ? $this->functions : $this->functions = $functions;
	}

	public function topologyOrientation($topologyOrientation = null) {
		return empty($topologyOrientation) ? $this->topologyOrientation : $this->topologyOrientation = $topologyOrientation;
	}

	public function topologyLength($topologyLength = null) {
		return empty($topologyLength) ? $this->topologyLength : $this->topologyLength = $topologyLength;
	}

	public function profileType($profileType = null) {
		return empty($profileType) ? $this->profileType : $this->profileType = $profileType;
	}

	public function segmentType($segmentType = null) {
		return empty($segmentType) ? $this->segmentType : $this->segmentType = $segmentType;
	}

	//public function transType($transType = null) {
	//	return empty($transType) ? $this->transType : $this->transType = $transType;
	//}

	private function getSignalValue() {
		if ($this->isSignal === true || $this->isSignal === "1") {
			return 1;
		} else {
			return 0;
		}
	}

	public function singalLength($singalLength = null) {
		return empty($singalLength) ? $this->singalLength : $this->singalLength = $singalLength;
	}

	public function values($rows = array()) {
		if(count($rows) > 0) {
			$this->id = isset($rows['id']) ? $rows['id'] : "";
			$this->dateLastModified = $rows['date_last_modified'];
			$this->dateCreated = $rows['date_created'];
			$this->sequence = $rows['sequence'];
			$this->subcellularLocation = $rows['subcellular_location'];
			$this->entryId = $rows['entry_ID'];
			$this->entryName = $rows['entry_name'];
			$this->taxonomicLineage = $rows['taxonomic_lineage'];
			$this->proteinExistence = $rows['protein_existence'];
			$this->sequenceLength = $rows['sequence_length'];
			$this->fasta = $rows['fasta'];
			$this->isSignal = $rows['is_signal'];
			$this->functions = $rows['function'];
			$this->topologyOrientation = $rows['topology_orientation'];
			$this->topologyLength = $rows['topology_length'];
			$this->segmentType = $rows['segment_type'];
			$this->profileType = $rows['profile_type'];
			//$this->transType = $rows['trans_type'];
			$this->singalLength = $rows['signal_length'];
		}
	}

    public function save() {
		$dateLastModified = mysql_real_escape_string($this->dateLastModified);
		$dateCreated = mysql_real_escape_string($this->dateCreated);
		$sequence = mysql_real_escape_string($this->sequence);
		$subcellularLocation = mysql_real_escape_string($this->subcellularLocation);
		$entryId = mysql_real_escape_string($this->entryId);
		$entryName = mysql_real_escape_string($this->entryName);
		$taxonomicLineage = mysql_real_escape_string($this->taxonomicLineage);
		$proteinExistence = mysql_real_escape_string($this->proteinExistence);
		$sequenceLength = mysql_real_escape_string($this->sequenceLength);
		$fasta = mysql_real_escape_string($this->fasta);
		$signal = $this->getSignalValue();
		$functions = mysql_real_escape_string($this->functions);
		$topologyOrientation = mysql_real_escape_string($this->topologyOrientation);
		$topologyLength = mysql_real_escape_string($this->topologyLength);
		$profileType = mysql_real_escape_string($this->profileType);
		$segmentType = mysql_real_escape_string($this->segmentType);
		//$transType = mysql_real_escape_string($this->transType);
		$singalLength = mysql_real_escape_string($this->singalLength);

		//$query = "INSERT INTO ".$this->tableName."(`sequence`,`subcellular_location`,`protein_existence`,`sequence_length`,`taxonomic_lineage`,`date_created`,`entry_name`,`entry_ID`,`date_last_modified`, `fasta`, `is_signal`, `function`, `topology_orientation`, `topology_length`, `profile_type`, `segment_type`, `trans_type`) VALUES ('$sequence','$subcellularLocation','$proteinExistence','$sequenceLength','$taxonomicLineage','$dateCreated','$entryName','$entryId', '$dateLastModified', '$fasta', '$signal', '$function', '$topologyOrientation', '$topologyLength', '$profileType', '$segmentType', '$transType')";

		$query = "INSERT INTO ".$this->tableName."(`sequence`,`subcellular_location`,`protein_existence`,`sequence_length`,`taxonomic_lineage`,`date_created`,`entry_name`,`entry_ID`,`date_last_modified`, `fasta`, `is_signal`, `function`, `topology_orientation`, `topology_length`, `profile_type`, `segment_type`, `signal_length`) VALUES ('$sequence','$subcellularLocation','$proteinExistence','$sequenceLength','$taxonomicLineage','$dateCreated','$entryName','$entryId', '$dateLastModified', '$fasta', '$signal', '$functions', '$topologyOrientation', '$topologyLength', '$profileType', '$segmentType', '$singalLength')";

		$statement = $this->dbConn->prepare($query);
		try {
			$result = $statement->execute();
            $this->dbConn = null;
		} catch(Exception $e) {
			$result = false;
		}

        return $result;
    }

	public function existed() {
		$query = "SELECT * FROM ".$this->tableName." WHERE entry_ID='$this->entryId' AND entry_name='$this->entryName'";
		$statement = $this->dbConn->prepare($query);
		$statement->execute();
		$result = $statement->fetch();

		if ($result === false) {
			return false;
		} else {
			return true;
		}
	}

    public function delete() {
		$entryID = $this->entryId;
		$entryName = $this->entryName;

        $query = "DELETE FROM ".$this->tableName." WHERE entry_ID='$entryID' AND entry_name='$entryName'";
        $statement = $this->dbConn->prepare($query);
        $result = $statement->execute();

        return $result;
    }

    public function update() {
    	$dateLastModified = mysql_real_escape_string($this->dateLastModified);
		$dateCreated = mysql_real_escape_string($this->dateCreated);
		$sequence = mysql_real_escape_string($this->sequence);
		$subcellularLocation = mysql_real_escape_string($this->subcellularLocation);
		$entryId = mysql_real_escape_string($this->entryId);
		$entryName = mysql_real_escape_string($this->entryName);
		$taxonomicLineage = mysql_real_escape_string($this->taxonomicLineage);
		$proteinExistence = mysql_real_escape_string($this->proteinExistence);
		$sequenceLength = mysql_real_escape_string($this->sequenceLength);
		$fasta = mysql_real_escape_string($this->fasta);
		$signal = $this->getSignalValue();
		$functions = mysql_real_escape_string($this->functions);
		$topologyOrientation = mysql_real_escape_string($this->topologyOrientation);
		$topologyLength = mysql_real_escape_string($this->topologyLength);
		$segmentType = mysql_real_escape_string($this->segmentType);
		$profileType = mysql_real_escape_string($this->profileType);
		//$transType = mysql_real_escape_string($this->transType);
		$singalLength = mysql_real_escape_string($this->singalLength);

	    $updates = empty($dateLastModified) ? "" : " date_last_modified='".$this->dateLastModified."'" ;
		$updates .= empty($dateCreated) ? "" : (($updates != "") ? ", date_created='".$this->dateCreated."'"  : " date_created='".$this->dateCreated."'" );
		$updates .= empty($entryId) ? "" : (($updates != "") ? ", entry_ID='".$this->entryId."'"  : " entry_ID='".$this->entryId."'" );
		$updates .= empty($this->entryName) ? "" : (($updates != "") ? ", entry_name='".$this->entryName."'"  : " entry_name='".$this->entryName."'" );
		$updates .= empty($this->taxonomicLineage) ? "" : (($updates != "") ? ", taxonomic_lineage='".mysql_real_escape_string($this->taxonomicLineage)."'"  : " taxonomic_lineage='".mysql_real_escape_string($this->taxonomicLineage)."'" );
		$updates .= empty($this->proteinExistence) ? "" : (($updates != "") ? ", protein_existence='".$this->proteinExistence."'"  : " protein_existence='".$this->proteinExistence."'" );
		$updates .= empty($this->sequenceLength) ? "" : (($updates != "") ? ", sequence_length='".$this->sequenceLength."'" : " sequence_length='".$this->sequenceLength."'" );
		$updates .= empty($this->sequence) ? "" : (($updates != "") ? ", sequence='".$this->sequence."'"  : " sequence='".$this->sequence."'" );
		$updates .= empty($this->subcellularLocation) ? "" : (($updates != "") ? ", subcellular_location='".mysql_real_escape_string($this->subcellularLocation)."'"  : " subcellular_location='".mysql_real_escape_string($this->subcellularLocation)."'" );
		$updates .= empty($this->fasta) ? "" : (($updates != "") ? ", fasta='".$this->fasta."'"  : " fasta='".$this->fasta."'" );
		$updates .= (($updates != "") ? ", `is_signal`='".$this->getSignalValue()."'"  : " `is_signal`='".$this->getSignalValue()."'" );
		$updates .= empty($this->functions) ? "" : (($updates != "") ? ", function='".$this->functions."'"  : " function='".$this->functions."'" );
		$updates .= empty($this->topologyOrientation) ? "" : (($updates != "") ? ", topology_orientation='".$this->topologyOrientation."'"  : " topology_orientation='".$this->topologyOrientation."'" );
		$updates .= empty($this->topologyLength) ? "" : (($updates != "") ? ", topology_length='".$this->topologyLength."'"  : " topology_length='".$this->topologyLength."'" );
		$updates .= empty($this->profileType) ? "" : (($updates != "") ? ", profile_type='".$this->profileType."'"  : " profile_type='".$this->profileType."'" );
		$updates .= empty($this->segmentType) ? "" : (($updates != "") ? ", segment_type='".$this->segmentType."'"  : " segment_type='".$this->segmentType."'" );
		//$updates .= empty($this->transType) ? "" : (($updates != "") ? ", trans_type='".$this->transType."'"  : " trans_type='".$this->transType."'" );
		$updates .= empty($this->singalLength) ? "" : (($updates != "") ? ", signal_length='".$this->singalLength."'"  : " signal_length='".$this->singalLength."'" );

		$entryId = $this->entryId;
		$entryName = $this->entryName;

		$query = "UPDATE ".$this->tableName." SET $updates WHERE entry_ID='$entryId' AND entry_name='$entryName'";

        $statement = $this->dbConn->prepare($query);

        try {
        	$result = $statement->execute();
        } catch (Exception $e) {
        	$result = false;
        }

		return $result;
    }

    public function findBy($condition = null, $limit = 10, $offset = 0) {
    	$result = parent::findBy($condition, $limit, $offset);
    	$proteins = array();
    	foreach ($result as $key => $value) {
    		$protein = new SPProteinModel();
    		$protein->values($value);
    		$proteins[] = $protein;
    	}
    	return $proteins;
    }
}

?>
