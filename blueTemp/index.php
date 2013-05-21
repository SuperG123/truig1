<?php
echo("<h1>Welcome To TRUIG1</h1>");

$dbu='truigone_superg';
$dbp='1{eRIc}0';
try {
	$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
$stmt = $dbh->query("SELECT test1col from test1");
$rc = $stmt->rowCount();
if($rc > 1){
	//run results
	$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $res){
		echo('name: '.$res['test1col'].'<br/>');
	}
}

?>