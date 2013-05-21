<?php 
$_SESSION['login']=0;
?>

<article>
		<div id="mainCont">
		<form id="mainForm" action="index.php" method="post">
			<div id="uid">
			<label for="user">User ID</label><br/>
			<input type="text" name="user" id="user" autofocus />
			</div>
			<div id="upa">
			<label for="pass">Password</label><br/>
			<input type="password" name="pass" id="pass" />
			</div>
			<div id="clicker">
			<br/>
			<input type="hidden" name="m" value="main"/>
			<input type="hidden" name="cont" value="logger" />
			<button type="submit" id="logBut">Log In</button>
			</div>
		</form> 
		</div>
	</article>
	<nav>
		<ul>
		<li><div id="usrHelp">Help</div></li>
		<li><div id="msgClicker1">Send Message</div></li>
		</ul>
	</nav>
	<?php include_once 'scr/helpUser.php'; ?>
	<script>
	//view help
	$('#helpUserDialog').dialog({
				autoOpen:false,
				width:600,
				height:600,
				show:{effect:"fadeIn",duration:1000},
				hide:{effect:"fadeOut",duration:1000}
		});
	$('nav ul li').on('click','#usrHelp',function(e){		
		$('#helpUserDialog').dialog('open');
		$('#helpUserDialog').dialog('option','title','User Help');
	});
	
	//send message
	 $('nav ul li').delegate('#msgClicker1','click',function(e){
	 	$('body').append('<div id="sMsgDia"><div id="frmMsg">click test</div></div>');
	 	$.getJSON('scr/getMsgTo.php',function(data){
		 	var items=[];
		 	$.each(data, function(key,val){
			 	items.push('<option value="'+key+'">'+val+'</option>');
		 	});		 
		$('#frmMsg').html('<form id="theMsgFrm"><div id="msgTo"><label for="frmMsgTo">Send Message To:</label><br/><select name="frmMsgTo" id="frmMsgTo">'+items.join('')+'<select></div><div id="msgFrom"><label for="frmMsgFrm">From:</label><br/><input type="text" name="frmMsgFrm" id="frmMsgFrm" /></div><div id="msgSub"><label for="frmMsgSub">Subject:</label><br/><input type="text" name="frmMsgSub" id="frmMsgSub" /></div><div id="msgMsg"><label for="frmMsgMsg">Message:</label><br/><textarea name="frmMsgMsg" id="frmMsgMsg" rows=4 cols=20 ></textarea></div><p id="frmMsgSndBut">Send</p></form>');
		});

		$('#sMsgDia').dialog({
			 autoOpen:false,
			 width:300,
			 height:350,
			 show:{
				 effect:     "fadeIn",
				 duration:   1000
			 },
		 	 hide:{
			 	 effect:     "fadeOut",
			 	 duration:   1000
		 	 }
		 });
	 	$('#sMsgDia').dialog('open');
		$('#sMsgDia').dialog('option','title','Message');
		//
	 }); 

	 $('body').delegate('p#frmMsgSndBut','click',function(e){
		 //alert('button click'+$('#frmMsgFrm').val());

		var msgPost = $.post('scr/msgSave.php',{to:$('#frmMsgTo').val(),from:$('#frmMsgFrm').val(),sub:$('#frmMsgSub').val(),msg:$('#frmMsgMsg').val()});
			msgPost.done(function(data){
				$('#frmMsg').html('Your message has been sent');
				$('#sMsgDia').dialog('close').delay(300);
			});

	 });
 </script>