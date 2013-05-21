<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>TRU Scan v0.1</title>
<link rel="stylesheet" href="styles/css/truScan.css" type="text/css" />
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

 <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/smoothness/jquery-ui.css" type="text/css" /> 
 <script src="js/ts.js"></script>
</head>
<body>
  <header>
		<div id="imgHolder"><img src="img/truTempLogo.png"></div>
      <h1>Product Scanner</h1>
  </header>
  <div id="msgBox"></div>
  <div id="mainBody">
<?php

	if(isset($_REQUEST['cont'])){
		$sw=$_REQUEST['cont'];
	}else{
		$sw="";
	}
	switch($sw){
		case 'logOut':
			unset($_GET['ui']);
			//echo('You are now logged out.');
			include_once 'scr/start.php';
			break;
		case 'rnew':
			include_once 'scr/revNew.php';
			break;
		case 'addProd':
			include_once 'scr/addProd1.php';
			break;
		case 'compFnd':
			include_once 'scr/fndComp.php';
			break;
		case 'msg':
			include_once 'scr/getMsg.php';
			break;
		case 'scan':
			include_once 'scr/logScr2.php';
			break;
		case 'addUsr':
			include_once 'scr/addUser.php';
			break;
		case 'logger':
			include_once 'scr/logger.php';
			break;
		default:
			unset($_GET['ui']);
			//echo("You are now logged out");
			include_once 'scr/start.php';
			break;
	}
?>
  </div>
  <footer> <p>the footer</p> </footer>

</body>