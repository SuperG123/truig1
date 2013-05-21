<?php

if($_REQUEST['so']==1){
	echo sendOut($_REQUEST['tId']);
}
if($_REQUEST['so']==2){
	echo sendNewOut($_REQUEST['tId']);
}
if($_REQUEST['so']==3){
	delUtil($_REQUEST['tbl'], $_REQUEST['col'], $_REQUEST['colId']);
}

function sendOut($tId){
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	
		$tId1 = $tId;
	//declare vars (hey, we had to get rid of the stored proc bare with us here)
	$sku 	= "";
	$upc 	= "";
	$src 	= "";
	$price 	= "";
	$ttp    = "";
	$cost 	= "";
	$unit 	= "";
	$om 	= "";
	$weight = "";
	$dims 	= "";
	$vend 	= "";
	$cata1 	= "";
	$cata2 	= "";
	$cata3 	= "";
	$cata4 	= "";
	$desc1 	= "";
	$desc2 	= "";
	$loc 	= "";
	$cnt	= "";
	
	$upcCur = $dbh->prepare('SELECT tsSku,tsUpc,tsSource,tsPrice,tsCost,tsUnit,tsOM,tsWeight,tsDims,tsVendNum,tsCata1,tsCata2,tsCata3,tsCata4,tsDesc1,tsDesc2,tsSrcSku FROM tsdat WHERE tsId = :inId');
	$upcCur->execute(array(':inId'=>$tId));
	$upcCt=$upcCur->rowCount();
	$upcRes = $upcCur->fetchAll(PDO::FETCH_ASSOC);
	if($upcCt==1){
		$sku=$upcRes[0]['tsSku'];
		$upc=$upcRes[0]['tsUpc'];
		$src=$upcRes[0]['tsSource'];
		$price=$upcRes[0]['tsPrice'];
		$cost=$upcRes[0]['tsCost'];
		$unit=$upcRes[0]['tsUnit'];
		$om=$upcRes[0]['tsOM'];
		$weight=$upcRes[0]['tsWeight'];
		$dims=$upcRes[0]['tsDims'];
		$vend=$upcRes[0]['tsVendNum'];
		$cata1=$upcRes[0]['tsCata1'];
		$cata2=$upcRes[0]['tsCata2'];
		$cata3=$upcRes[0]['tsCata3'];
		$cata4=$upcRes[0]['tsCata4'];
		$desc1=$upcRes[0]['tsDesc1'];
		$desc2=$upcRes[0]['tsDesc2'];
		$srcSku=$upcRes[0]['tsSrcSku'];
		
	}
	if($sku != ""){
		$locCur = $dbh->prepare('SELECT tsFndCt,tsFndLoc,tsFndAltPrice1 FROM tsfnd WHERE tsFndSku = :sku');
		$locCur->execute(array(':sku'=>$sku));
		$locCt = $locCur->rowCount();
		$locRes = $locCur->fetchAll(PDO::FETCH_ASSOC);
		if($locCt==1){
			$loc=$locRes[0]['tsFndLoc'];
			$cnt=$locRes[0]['tsFndCt'];
			$ttp=$locRes[0]['tsFndAltPrice1'];
		}
	}
	if($loc!=""){
		$outCur = $dbh->prepare('SELECT tsOutSku FROM tsout WHERE tsOutSku = :sku');
		$outCur->execute(array(':sku'=>$sku));
		$outCt = $outCur->rowCount();
		if($outCt==1){
			$outUpdate = $dbh->prepare('UPDATE tsout SET tsOutSku = :sku,tsOutUpc = :upc,tsOutPrice = :price,tsOutCost = :cost,tsOutSource = :src,tsOutVendNum = :vend,tsOutUnit = :unit,tsOutOM = :om,tsOutWeight = :weight,tsOutQty = :cnt,tsOutLoc = :loc,tsOutDims = :dims,tsOutCata1 = :cata1,tsOutCata2 = :cata2,tsOutCata3 = :cata3,tsOutCata4 = :cata4,tsOutDesc1 = :desc1,tsOutDesc2 = :desc2,tsOutAltPrice1 = :ttp WHERE tsOutSku = :sku');
			$outUpdate->execute(array(':sku'=>$sku,':upc'=>$upc,':src'=>$src,':price'=>$price,':cost'=>$cost,':vend'=>$vend,':om'=>$om,':weight'=>$weight,':dims'=>$dims,':cnt'=>$cnt,':loc'=>$loc,':unit'=>$unit,':cata1'=>$cata1,':cata2'=>$cata2,':cata3'=>$cata3,':cata4'=>$cata4,':desc1'=>$desc1,':desc2'=>$desc2,':ttp'=>$ttp));
			$outRet='Record Updated';
		}else{
			$outNew = $dbh->prepare('INSERT INTO tsout(tsOutSku,tsOutUpc,tsOutSource,tsOutPrice,tsOutQty,tsOutLoc,tsOutDesc1,tsOutDesc2,tsOutCost,tsOutUnit,tsOutOM,tsOutCata1,tsOutCata2,tsOutCata3,tsOutCata4,tsOutWeight,tsOutDims,tsOutVendNum,tsOutAltPrice1) VALUES(:sku,:upc,:src,:price,:cnt,:loc,:desc1,:desc2,:cost,:unit,:om,:cata1,:cata2,:cata3,:cata4,:weight,:dims,:vend,:ttp)');
			$outNew->execute(array(':sku'=>$sku,':upc'=>$upc,':src'=>$src,':price'=>$price,':cost'=>$cost,':vend'=>$vend,':om'=>$om,':weight'=>$weight,':dims'=>$dims,':cnt'=>$cnt,':loc'=>$loc,':unit'=>$unit,':cata1'=>$cata1,':cata2'=>$cata2,':cata3'=>$cata3,':cata4'=>$cata4,':desc1'=>$desc1,':desc2'=>$desc2,':ttp'=>$ttp));
			$outRet='Record Created';
		}
	}else{
		$outRet = 'error';
	}

	return $outRet;
}
function sendNewOut($tId){
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	$tId1 = $tId;
	//declare vars (hey, we had to get rid of the stored proc bare with us here)
	$sku 	= "---";
	$upc 	= "---";
	$src 	= "---";
	$price 	= "---";
	$cost 	= "---";
	$unit 	= "---";
	$om 	= "---";
	$weight = "---";
	$dims 	= "---";
	$vend 	= "---";
	$cata1 	= "---";
	$cata2 	= "---";
	$cata3 	= "---";
	$cata4 	= "---";
	$desc1 	= "---";
	$desc2 	= "---";
	$loc 	= "---";
	$cnt	= "---";
	$ttp1	= "---";

	$upcCur = $dbh->prepare('SELECT * FROM tsnew WHERE tsNewId = :inId');
	$upcCur->execute(array(':inId'=>$tId));
	$upcCt=$upcCur->rowCount();
	$upcRes = $upcCur->fetchAll(PDO::FETCH_ASSOC);
	if($upcCt==1){
		$sku=$upcRes[0]['tsNewSku'];
		$upc=$upcRes[0]['tsNewUpc'];
		$price=$upcRes[0]['tsNewPrice'];
		$cost=$upcRes[0]['tsNewCost'];
		$weight=$upcRes[0]['tsNewWeight'];
		$dims=$upcRes[0]['tsNewDims'];
		$vend=$upcRes[0]['tsNewVendor'];
		$cata1=$upcRes[0]['tsNewCata'];
		$desc1=$upcRes[0]['tsNewDesc'];
		$loc=$upcRes[0]['tsNewLoc'];
		$cnt==$upcRes[0]['tsNewCt'];
		$ttp1==$upcRes[0]['tsNewAltPrice1'];
		
	}
//var_dump($upcRes);
//echo($tId.':'.$_REQUEST['so']);
	if($sku!=""){
		$outNew = $dbh->prepare('INSERT INTO tsout(tsOutSku,tsOutUpc,tsOutSource,tsOutPrice,tsOutQty,tsOutLoc,tsOutDesc1,tsOutDesc2,tsOutCost,tsOutUnit,tsOutOM,tsOutCata1,tsOutCata2,tsOutCata3,tsOutCata4,tsOutWeight,tsOutDims,tsOutVendNum,tsOutAltPrice1) VALUES(:sku,:upc,:src,:price,:cnt,:loc,:desc1,:desc2,:cost,:unit,:om,:cata1,:cata2,:cata3,:cata4,:weight,:dims,:vend,:ttp)');
		$outNew->execute(array(':sku'=>$sku,':upc'=>$upc,':src'=>$src,':price'=>$price,':cost'=>$cost,':vend'=>$vend,':om'=>$om,':weight'=>$weight,':dims'=>$dims,':cnt'=>$cnt,':loc'=>$loc,':unit'=>$unit,':cata1'=>$cata1,':cata2'=>$cata2,':cata3'=>$cata3,':cata4'=>$cata4,':desc1'=>$desc1,':desc2'=>$desc2,':ttp'=>$upcRes[0]['tsNewAltPrice1']));
		$outRet='Record Created';
		//Kill saved in tsNew
		$killNew = $dbh->prepare('DELETE FROM tsnew WHERE tsNewId = :inId');
		$killNew->execute(array(':inId'=>$tId));
	}else{
		$outRet='Error - Record Not Created';
	}

	return $outRet;
}

function delUtil($table,$col,$colId){
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	$sql='DELETE FROM '.$table.' WHERE '.$col.' = '.$colId;
	$killEmAll = $dbh->prepare($sql);
	$killEmAll->execute();
	return 'dead';
}
