<?php
require_once("../model/SPProteinModel.php");

header("Content-type:text/plain");

function mockupProtein_1() {
	$protein = new SPProteinModel();
	$protein->entryId("Q6GZX4");
	$protein->entryName("001R_FRG3G");
	$protein->sequence("MAFSAEDVLK EYDRRRRMEA LLLSLYYPND RKLLDYKEWS PPRVQVECPK APVEWNNPPS
 EKGLIVGHFS GIKYKGEKAQ ASEVDVNKMC CWVSKFKDAM RRYQGIQTCK IPGKVLSDLD
 AKIKAYNLTV EGVEGFVRYS RVTKQHVAAF LKELRHSKQY ENVNLIHYIL TDKRVDIQHL
 EKDLVKDFKA LVESAHRMRQ GHMINVKYIL YQLLKKHGHG PDGPDILTVK TGSKGVLYDD
 SFRKIYTDLG WKFTPL");
	$protein->subcellularLocation("subcellularLocation");
	$protein->profileType("Single-pass");
	$protein->segmentType("Single-pass membrane");
	$protein->segmentType("Transmembrane");
	$protein->sequenceLength("256 AA");
	$protein->taxonomicLineage("Viruses");
	$protein->proteinFunction("Transcription activation. {ECO:0000305}.");
	$protein->topologyOrientation("orientation");
	$protein->topologyLength("length");
	$protein->dateCreated("19-07-2004");
	$protein->dateLastModified("01-04-2015");
	$protein->fasta(">sp|Q6GZX4|001R_FRG3G
MAFSAEDVLKEYDRRRRMEALLLSLYYPNDRKLLDYKEWSPPRVQVECPKAPVEWNNPPS
EKGLIVGHFSGIKYKGEKAQASEVDVNKMCCWVSKFKDAMRRYQGIQTCKIPGKVLSDLD
AKIKAYNLTVEGVEGFVRYSRVTKQHVAAFLKELRHSKQYENVNLIHYILTDKRVDIQHL
EKDLVKDFKALVESAHRMRQGHMINVKYILYQLLKKHGHGPDGPDILTVKTGSKGVLYDD
SFRKIYTDLGWKFTPL");
	$protein->proteinExistence("Predicted");
	$protein->isSignal(false);

	return $protein;
}

function printResult($pass, $method, $message) {
	$result = $pass === false ? "FAIL ----- [$method] : $message\n" : "PASS ----- [$method] : $message\n";
	echo $result;
}

function randomEntryId() {
	$length = 6;
	$randomString = substr(str_shuffle(md5(time())),0,$length);
	return $randomString;
}

function testSave() {
	$protein = mockupProtein_1();
	if ($protein->existed() === true) {
		$protein->entryId(randomEntryId());
	}
	if ($protein->save() === false) {
		printResult(false, __METHOD__, "Protein not saved.");
	} else {
		printResult(true, __METHOD__, "Protein saved.");	
	}
}

function testDoesExist() {
	$protein = mockupProtein_1();
	$result = $protein->existed();
	if ($result === false) {
		printResult(false, __METHOD__, "Protein does not exist. Supposedly, protein should be existing.");
	} else {
		printResult(true, __METHOD__, "Protein does exist.");
	}
}

function testDoesNotExist() {
	$protein = mockupProtein_1();
	$protein->entryId(randomEntryId());
	$result = $protein->existed();
	if ($result === true) {
		printResult(false, __METHOD__, "Protein does exist. Supposedly, protein should not be existing.");
	} else {
		printResult(true, __METHOD__, "Protein does not exist.");
	}
}

function testUpdate() {
	$protein = mockupProtein_1();
	$protein->dateLastModified("06-27-2015");
	$result = $protein->update();
	if ($result === false) {
		printResult(false, __METHOD__, "Protein not updated.");
	} else {
		printResult(true, __METHOD__, "Protein successfully updated.");
	}
}

function testDelete() {
	$protein = mockupProtein_1();
	$result = $protein->delete();
	if ($result === false) {
		printResult(false, __METHOD__, "Protein not deleted.");
	} else {
		printResult(true, __METHOD__, "Protein successfully deleted.");
	}
}

function testFindByEntryId() {
	$protein = new SPProteinModel();
	$protein_1 = mockupProtein_1();
	$result = $protein->findBy("WHERE entry_ID='$protein_1->entryId'");
	if ($result[0]->entryId !== $protein_1->entryId) {
		printResult(false, __METHOD__, "Protein not found via entry_ID.");
	} else {
		printResult(true, __METHOD__, "Protein found via entry_ID.");
	}
}

testSave();
testDoesExist();
testDoesNotExist();
testUpdate();
testFindByEntryId();
testDelete();

?>