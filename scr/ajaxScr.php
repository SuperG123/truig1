<?php
/*
** this page will have the ajax functions needed by truScan
** functions:
**   mainEntry
**   scanner
**
*/

if(isset($_POST['m'])){$m=$_POST['m'];}
if($m == 'main'){
	echo(mainDisp());
}
//if($_POST['mReq'] == 'login'){
//	echo(mainLog($_POST['user'],$_POST['pass']));
//	}

function mainDisp(){
		?>
		<form id="mainForm">
			<div id="uid">
			<label for="user">User ID</label><br/>
			<input type="text" id="user" autofocus />
			</div>
			<div id="upa">
			<label for="pass">Password</label><br/>
			<input type="password" id="pass" />
			</div>
			<div id="clicker">
			<br/>
			<button type="button" id="logBut">Log In</button>
			</div>
		</form>
		<script>
	//		$('#logBut').click(function(event){
	//		alert('but click, but click');
	//		});
		</script>
		<?php
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
}
?>