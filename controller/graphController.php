<?php

$function = $_POST['func'];
$function();

function getData(){
	include '../lib/PDO_connect.php';
	$result = $db->prepare("SELECT sequence_length, count(id) as 'id' FROM sp_protein GROUP BY sequence_length");
	$result->execute();
	$datas = $result->fetchAll();

	foreach($datas as $data => $value){
		$temp .= "['".$value['sequence_length']."',".$value['id']."],";
	}
	$temp2 = substr($temp, 0, -1);
	//print_r("[".$temp2."]");
}

?>