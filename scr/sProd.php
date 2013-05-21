<?php
//$jsonOut=array('tst1' => $_REQUEST['sku'],'tst2'=>'tst2val1');
//$jo=json_encode($jsonOut);
//echo($jo);
echo(getDat($_REQUEST['sku']));


function getDat($s = 'x',$u = 'x'){
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	$stmt = $dbh->query("SELECT * from tsdat WHERE tsSku='".$s."' OR tsUpc='".$u."' OR tsSrcSku='".$s."'");
	$rc = $stmt->rowCount();
	if($rc > 0){
		//run results
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($results);
		//echo('<hr/>');
		//echo($results[0]['tsSku'].'<br/>');
		$jsonOut=array('SKU'=>$results[0]['tsSku'],'UPC'=>$results[0]['tsUpc'],'desc'=>$results[0]['tsDesc1'],'cata1'=>$results[0]['tsCata1'],'cata2'=>$results[0]['tsCata2'],'srcSku'=>$results[0]['tsSrcSku']);
		$jo=json_encode($jsonOut);
	}else{
		$jsonOut=array('error'=>'nf');
		$jo=json_encode($jsonOut);
	}
	return $jo;
}

?>