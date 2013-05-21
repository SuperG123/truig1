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
$sql="INSERT INTO tsmsg(tsMsgTo,tsMsgFrom,tsMsgSub,tsMsgMsg) VALUES(:msgTo,:msgFrom,:msgSub,:msgMsg)";
$qry=$dbh->prepare($sql);
$qry->execute(array(':msgTo'=>$_REQUEST['to'],
					':msgFrom'=>$_REQUEST['from'],
					':msgSub'=>$_REQUEST['sub'],
					':msgMsg'=>$_REQUEST['msg']
));
echo('saved');