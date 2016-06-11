<?php
header('Content-disposition: attachment; filename=gen.txt');
header('Content-type: text/plain');


session_start();

if ($_REQUEST['action'] == 'fasta')
{
	echo $_SESSION['fasta'];
}

elseif ($_REQUEST['action'] == 'text') 
{	
	echo $_SESSION['filter_txt'];
	echo $_SESSION['filter_body_text'];
}

?>
