<?php
$sku=$_REQUEST['sku'];
$qty=$_REQUEST['qty'];
$loc=$_REQUEST['loc'];
$ttp=$_REQUEST['ttp'];
$ssk=$_REQUEST['ssk'];
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
$sql="INSERT INTO tsfnd(tsFndSku,tsFndCt,tsFndLoc,tsFndAltPrice1,tsFndSrcSku) VALUES(:sku,:qty,:loc,:ttp,:ssk)";
$qry=$dbh->prepare($sql);
if($qry->execute(array(':sku'=>$sku,
					':qty'=>$qty,
					':loc'=>$loc,
					':ttp'=>$ttp,
					':ssk'=>$ssk
					))==true){
	$saveRes=array('saved'=>'true');
	echo(json_encode($saveRes));
}else{
	$saveRes=array('error'=>'true');
	echo(json_encode($saveRes));
}
