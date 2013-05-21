<?php
if(isset($_POST['m'])){$m=$_POST['m'];}
if(isset($_POST['user'])){$u=$_POST['user'];}
if(isset($_POST['pass'])){$p=$_POST['pass'];}

if($m == 'main'){
	echo(mainLog($u,$p));
}

function mainLog($u,$p){
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	$stmt = $dbh->query("SELECT * from tsindv WHERE tsIndvUN='".$u."' AND (tsIndvP = '".$p."')");
	$rc = $stmt->rowCount();
	if($rc == 1){
		//run results
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if($results[0]['tsIndvAct']==1 && $results[0]['tsIndvSU']==0){
			// Regular user
			if($_SESSION['login']==0 && $results[0]['tsIndvAct']==1){
				$stuff=crypt('askldfjaslkdjglkasdkdkglasdkjdgg');
				header('Location:index.php?cont=scan&ui='.base64_encode('1,'.$stuff.',0,'.$results[0]['tsIndvId']));
			}
		}else if($results[0]['tsIndvAct']==1 && $results[0]['tsIndvSU']==1){
			//super user
		if($_SESSION['login']==0 && $results[0]['tsIndvAct']==1){
			$stuff=crypt('askldfjaslkdjglkasdkdkglasdkjdgg');
				header('Location:index.php?cont=scan&ui='.base64_encode('1,'.$stuff.',1,'.$results[0]['tsIndvId']));
			}
			
		}else{
			// Error Msg
			echo "error";
		}
	}
}