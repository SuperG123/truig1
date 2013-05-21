<?php
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

$sql="DELETE FROM tsnew WHERE tsNewID = ".$_REQUEST['mId'];
$qry=$dbh->prepare($sql);
$qry->execute();

echo "Message Deleted";