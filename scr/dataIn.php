<?php
if($_REQUEST['f']=='saveDat'){
	print_r(saveDat());
}
if($_REQUEST['f']=='fileDat'){
	print_r(procDat('cpDat1.csv','TRU'));
}
function saveDat(){
	$fnArr= str_getcsv($_FILES['file']['name'],'.');
	$fn=$fnArr[0];
	$storagename = $_FILES["file"]["name"];
	move_uploaded_file($_FILES["file"]["tmp_name"], "../data/" . $storagename);
	$save = procDat($storagename,$_POST['fileSource']);
	if($save=='saved'){
		return $save;
	}else{
		return 'file proc error.';
	}
}

function procDat($fName0,$fileSource){
$fName = '../data/'.$fName0;

$iFile = fopen($fName,'r');
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
//echo('<table>');
while ($dat = fgetcsv($iFile,1000,',')){

// localize csv data	
	if($dat[0]){$upc= $dat[0];}else{$upc='---';}
	if($dat[1]){$sku = $dat[1];}else{$sku='---';}
	if($dat[2]){$desc1 = $dat[2];}else{$desc1='---';}
	if($dat[3]){$desc2 = $dat[3];}else{$desc2='---';}
	$desc3 = 'desc3';
	if($dat[4]){$weight = $dat[4];}else{$weight='---';}
	if($dat[5]){$cost = $dat[5];}else{$cost='---';}
	if($dat[6]){$price = $dat[6];}else{$price='---';}
	if($dat[7]){$tUnit = $dat[7];}else{$tUnit='---';}
	if($dat[8]){$om = $dat[8];}else{$om='---';}
	if($dat[9]){$cata1 = $dat[9];}else{$cata1='---';}
	if($dat[10]){$cata2 = $dat[10];}else{$cata2='---';}
	if($dat[11]){$cata3 = $dat[11];}else{$cata3='---';}
	if($dat[12]){$cata4 = $dat[12];}else{$cata4='---';}
	if($dat[13]){$vendNum = $dat[13];}else{$vendNum='---';}
	if($dat[14]){$dims = $dat[14];}else{$dims='---';}
	if($dat[15]){$srcSku = $dat[15];}else{$srcSku='---';}
	$src = $fileSource;
	
	if($upc == 'tsUpc'){
		next($dat);
		//echo('<tr><th>'.$upc.'</th><th>'.$sku.'</th><th>'.$desc1.'</th><th>'.$desc2.'</th><th>'.$weight.'</th><th>'.$cost.'</th><th>'.$price.'</th><th>'.$tUnit.'</th><th>'.$om.'</th><th>'.$cata1.'</th><th>'.$cata2.'</th><th>'.$cata3.'</th><th>'.$cata4.'</th><th>'.$vendNum.'</th><th>'.$dims.'</th></tr>');
	}else{
		//echo('<tr><td>'.$upc.'</td><td>'.$sku.'</td><td>'.$desc1.'</td><td>'.$desc2.'</td><td>'.$weight.'</td><td>'.$cost.'</td><td>'.$price.'</td><td>'.$tUnit.'</td><td>'.$om.'</td><td>'.$cata1.'</td><td>'.$cata2.'</td><td>'.$cata3.'</td><td>'.$cata4.'</td><td>'.$vendNum.'</td><th>'.$dims.'</th></tr>');
			$sql="INSERT INTO tsdat(tsSku,tsUpc,tsSource,tsPrice,tsDesc1,tsDesc2,tsDesc3,tsCost,tsUnit,tsOM,tsCata1,tsCata2,tsCata3,tsCata4,tsWeight,tsDims,tsVendNum,tsSrcSku) VALUES(:sku,:upc,:source,:price,:desc1,:desc2,:desc3,:cost,:tUnit,:om,:cata1,:cata2,:cata3,:cata4,:weight,:dims,:vend,:ssk)";
			$qry=$dbh->prepare($sql);
			$qry->execute(array(':sku'		=>$sku,
  						 	    ':upc'		=>$upc,
				   				':source'	=>$src,
			 	    			':price'	=>$price,
				   				':desc1'	=>$desc1,
				   				':desc2'	=>$desc2,
				   				':desc3'	=>$desc3,
				   				':cost'		=>$cost,
				   				':tUnit'	=>$tUnit,
				   				':om'		=>$om,
				   				':cata1'	=>$cata1,
				   				':cata2'	=>$cata2,
				   				':cata3'	=>$cata3,
				   				':cata4'	=>$cata4,
				   				':weight'	=>$weight,
				   				':dims'		=>$dims,
				   				':vend'		=>$vendNum,
								':ssk'		=>$srcSku
			));
		//print_r($qry->errorInfo());
	}
}
//echo('</table>');
fclose($iFile);
return 'saved';
}
?>