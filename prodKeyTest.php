<?php
$dbu='truigone_superg';
$dbp='1{eRIc}0';

try {
	$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
echo('start<hr/>');
$locCur = $dbh->prepare('SELECT tsId,tsVendNum FROM tsdat WHERE tsSource = "TRU"');
$locCur->execute();
$locRes = $locCur->fetchAll(PDO::FETCH_ASSOC);

foreach($locRes as $lin){
	$repIt = $dbh->prepare('UPDATE tsdat SET tsSku=:newSku,tsSrcSku=:newSrc WHERE tsId = :id');
	$repIt->execute(array(':newSku'=>$lin['tsVendNum'],':newSrc'=>'TR'.$lin['tsVendNum'],':id'=>$lin['tsId']));
	echo($lin['tsId'].'<br/>');
}
echo('<hr/>done... Check it.');
?>