<?php
$upc=$_REQUEST['upc'];
$sku=$_REQUEST['sku'];
$qty=$_REQUEST['qty'];
$loc=$_REQUEST['loc'];
$price=$_REQUEST['price'];
$desc=$_REQUEST['desc'];
$cata=$_REQUEST['cata'];
$weight=$_REQUEST['weight'];
$dims=$_REQUEST['dims'];
$vend=$_REQUEST['vend'];
$ttp =$_REQUEST['ttp'];

	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
$sql="INSERT INTO tsnew(tsNewSku,tsNewUpc,tsNewCt,tsNewLoc,tsNewVendor,tsNewPrice,tsNewCata,tsNewDesc,tsNewWeight,tsNewDims,tsNewAltPrice1) VALUES(:sku,:upc,:qty,:loc,:vend,:price,:cata,:desc,:weight,:dims,:ttp)";
$qry=$dbh->prepare($sql);
if($qry->execute(array(':sku'=>$sku,
					':upc'=>$upc,
					':qty'=>$qty,
					':loc'=>$loc,
					':vend'=>$vend,
					':price'=>$price,
					':cata'=>$cata,
					':desc'=>$desc,
					':weight'=>$weight,
					':dims'=>$dims,
					':ttp'=>$ttp
					))==true){
	$saveRes=array('saved'=>'true');
	echo(json_encode($saveRes));
}else{
	$saveRes=array('error'=>'true');
	echo(json_encode($saveRes));
}
