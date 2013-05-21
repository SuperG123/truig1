<?php
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

//retrieve data

$sql="UPDATE tsnew SET tsNewSku=:nsSku,tsNewUpc=:nsUpc,tsNewCt=:nsQty,tsNewLoc=:nsLoc,tsNewVendor=:nsVendor,tsNewPrice=:nsPrice,tsNewCost=:nsCost,tsNewCata=:nsCata1,tsNewDesc=:nsDesc,tsNewWeight=:nsWeight,tsNewDims=:nsDims,tsNewAltPrice1=:nsTtp WHERE tsNewId=:sId";	
$qry=$dbh->prepare($sql);
$qry->execute(array(':nsSku'=>$_REQUEST['nsSku'],
		':nsUpc'=>$_REQUEST['nsUpc'],
		':nsQty'=>$_REQUEST['nsQty'],
		':nsLoc'=>$_REQUEST['nsLoc'],
		':nsVendor'=>$_REQUEST['nsVendor'],
		':nsPrice'=>$_REQUEST['nsPrice'],
		':nsCost'=>$_REQUEST['nsCost'],
		':nsCata1'=>$_REQUEST['nsCata1'],
		':nsDesc'=>$_REQUEST['nsDesc'],
		':nsWeight'=>$_REQUEST['nsWeight'],
		':nsDims'=>$_REQUEST['nsDims'],
		':nsTtp'=>$_REQUEST['nsTtp'],
		':sId'=>$_REQUEST['sId']
));
echo('saved');