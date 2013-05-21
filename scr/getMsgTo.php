<?php
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

//$inSku = 'DW8250';
//retrieve data
$sql="SELECT tsIndvUN,tsIndvFN,tsIndvLN FROM tsindv";
$qry=$dbh->prepare($sql);
$qry->execute();
$res=$qry->fetchAll(PDO::FETCH_ASSOC);
$uList='{"":"",';
foreach($res as $usr){
	$uList = $uList.'"'.$usr['tsIndvFN'].$usr['tsIndvLN'].'":"'.$usr['tsIndvFN'].' '.$usr['tsIndvLN'].'",';
}
$uList=rtrim($uList,',').'}';
print_r($uList);