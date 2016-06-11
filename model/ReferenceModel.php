<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../lib/Model.php');

class ReferenceModel extends Model { 
		
	public $author;
	public $title;
	public $referenceNumber;
	public $citedFor;
	public $id;
	public $entryId;
	
	
	public $limit = null;
    public $offset = null;
	
	public function id($id = null) {
        return empty($id) ? $this->id : $this->id = $id;
    }

    public function entryId($entryId = null) {
        return empty($entryId) ? $this->entryId : $this->entryId = $entryId;
    }
	
	public function title($title = null) {
        return empty($title) ? $this->title : $this->title = $title;
    }
	
	public function author($author = null) {
        return empty($author) ? $this->author : $this->author = $author;
    }
	
	public function referenceNumber($referenceNumber = null) {
		return empty($referenceNumber) ? $this->referenceNumber : $this->referenceNumber = $referenceNumber;
	}
	
	public function citedFor($citedFor = null) {
		return empty($citedFor) ? $this->citedFor : $this->citedFor = $citedFor;
	}
	
	public function values($rows = array()){
		
		if(count($rows) > 0) {
			
			$this->entryId = isset($rows['entryId']) ? $rows['entryId']: null;
			$this->citedFor = isset($rows['citedFor']) ? mysql_real_escape_string($rows['citedFor']) : null;
			$this->title = isset($rows['title']) ? mysql_real_escape_string($rows['title']) : null;
			$this->referenceNumber = isset($rows['referenceNumber']) ?  mysql_real_escape_string($rows['referenceNumber']) : null;
			$this->author = isset($rows['author']) ? mysql_real_escape_string($rows['author']) : null;
			
		} 
	
	}
	
	public function __construct($tableName = null) {
        parent::__construct();        
		empty($tableName) ? $this->tableName = "references" : $this->tableName = $tableName;
    }
	
	public function save() {
	
		$entryId = $this->entryId;
		$citedFor = mysql_real_escape_string($this->citedFor);
		$title = mysql_real_escape_string($this->title);
		$referenceNumber = mysql_real_escape_string($this->referenceNumber);
		$author = mysql_real_escape_string($this->author);
		
		
		$this->dbConn->qry(" insert into `".$this->tableName."`(`entry_ID`,`author`,`title`,`reference_number`,`cited_for`) values('$entryId','$author','$title','$referenceNumber','$citedFor') ");

        return mysql_insert_id();
		
	}
	
	public function checkIfExist(){ 
		
		$referenceNum = mysql_real_escape_string($this->referenceNumber);
				
		$updates = empty($this->entryId) ? "" : " entry_ID='".$this->entryId."'";
		$updates .= empty($this->author) ? "" : (($updates != "") ? " and author='".mysql_real_escape_string($this->author)."'" : " author='".mysql_real_escape_string($this->author)."'" );
		$updates .= empty($this->citedFor) ? "" : (($updates != "") ? " and cited_for='".mysql_real_escape_string($this->citedFor)."'" : " cited_for='".mysql_real_escape_string($this->citedFor)."'" );		
		$updates .= empty($this->title) ? "" : (($updates != "") ? " and title='".mysql_real_escape_string($this->title)."'" : " title='".mysql_real_escape_string($this->title)."'" );		
		$updates .= empty($this->referenceNumber) ? "" : (($updates != "") ? " and reference_number='$referenceNum' " : " reference_number='$referenceNum' " );
	
		
		$rs = $this->dbConn->qry(" SELECT * FROM `".$this->tableName."` WHERE $updates ");
		
		return mysql_fetch_assoc($rs);
		
	}
	
	public function update(){
		
		$updates = empty($this->entryId) ? "" : " entry_ID='".$this->entryId."'" ;
		$updates .= empty($this->author) ? "" : (($updates != "") ? ", author='".mysql_real_escape_string($this->author)."'" : " author='".mysql_real_escape_string($this->author)."'" );
		$updates .= empty($this->citedFor) ? "" : (($updates != "") ? ", cited_for='".mysql_real_escape_string($this->citedFor)."'" : " cited_for='".mysql_real_escape_string($this->citedFor)."'" );		
		$updates .= empty($this->title) ? "" : (($updates != "") ? ", title='".mysql_real_escape_string($this->title)."'" : " title='".mysql_real_escape_string($this->title)."'" );		
		$updates .= empty($this->referenceNumber) ? "" : (($updates != "") ? ", reference_number='".mysql_real_escape_string($this->referenceNumber)."'" : " reference_number='".mysql_real_escape_string($this->referenceNumber)."'" );
		
		$id = $this->id;	
		
		
		$this->dbConn->qry(" UPDATE `".$this->tableName."` SET $updates WHERE id='$id' ");
		
		return true;
		
	}
	
	public function delete() {
	
		$id = $this->id;
        
        $this->dbConn->qry(" DELETE FROM ".$this->tableName." WHERE id='$id' ");
        
        return true;
		
	}
	
	
	
}

?>
