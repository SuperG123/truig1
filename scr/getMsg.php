<?php
$uid=str_getcsv(base64_decode($_GET['ui']));
if($uid[0]==1 && $uid[2]==1){
	echo(supUser($uid[3]));
}else if($uid[0]==1 && $uid[2]==0){
	echo(regUser($uid[3]));
}else{
	echo('login error.');
}

function regUser($id){
	?>
<article>
	<div id="mainCont">
		<div if="compDat">
			<p>Messages</p>
			<div id="msgDia"></div>
			<?php 
	$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

			$sql="SELECT tsIndvFN,tsIndvLN FROM tsindv WHERE tsIndvID = ".$id;
			$qry=$dbh->prepare($sql);
			$qry->execute();
			$res=$qry->fetchAll(PDO::FETCH_ASSOC);
			if(isset($res[0])){
			$msgKey=$res[0]['tsIndvFN'].$res[0]['tsIndvLN'];
			
			
			$sql2="SELECT * FROM tsmsg WHERE tsMsgTo = '".$msgKey."'";
			$qry2=$dbh->prepare($sql2);
			$qry2->execute();
			$res2=$qry2->fetchAll(PDO::FETCH_ASSOC);			

			echo('<table id="tblComp"><tr><th id="col1">From</th><th id="col2">Subject</th><th id="col3">Message</th><th id="col3"></th><th id="col4"></th><th id="col5">Action</th></tr>');
			foreach($res2 as $rf){
				$msgPrim=$rf['tsMsgMsg'];
				if(strlen($msgPrim)>50){
					$msgPrim=substr($msgPrim,0,50).'...';
				}
				$iTable2='<div id="msgReadFrom"><strong>From:</strong><br/>'.$rf['tsMsgFrom'].'</div><br/><div id="msgReadTo"><strong>To:</strong><br/>'.$rf['tsMsgTo'].'</div><br/><div id="msgReadSub"><strong>Subject:</strong><br/>'.$rf['tsMsgSub'].'</div><br/><div id="msgReadMsg"><strong>Message:</strong><br/>'.$rf['tsMsgMsg'].'</div><br/><div id="msgReadDate"><strong>Sent:</strong><br/>'.$rf['tsMsgSentDate'].'</div>';
				echo('<tr><td>'.$rf["tsMsgFrom"].'</td><td>'.$rf['tsMsgSub'].'</td><td>'.$msgPrim.'</td><td>&nbsp;</td><td>'.$rf['tsMsgTo'].'</td><td width=130px><button id="readBut" data-title='.$rf['tsMsgSub'].' value='.$rf['tsMsgId'].'>Read</button><button id="delBut" value='.$rf['tsMsgId'].'>Delete</button></td></tr>');
				echo('<div id="dialog" class="'.$rf['tsMsgId'].'">'.$iTable2.'</div>');			
			}
			echo('</table>');
			}else{
				echo('<div id="noMsg">There are no messages at this time</div>');
			}
			?>
		</div> 
	</div>

	<div id="prodInfo">
		<div id="prodInfoLabel"></div>
		<ul id="fList"></ul>
	</div>
</article>
  <nav>
    <ul>
      <li><a href='index.php?logOut=true'>Log Out</a></li>
      <li><div id="msgClicker1">Send Message</div></li>
      <li><a href='index.php?cont=msg&ui=<?php echo($_get['ui']) ?>'>View Messages</a></li>
    </ul>
  </nav>
 
<?php
}

function supUser($id){
	?>
<article>
	<div id="mainCont">
		<div if="compDat">
			<p>Messages</p>
			<div id="msgDia"></div>
			<?php 
				$dbu='truigone_superg';
	$dbp='1{eRIc}0';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=truigone_truscan', $dbu, $dbp);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
			$sql="SELECT tsIndvFN,tsIndvLN FROM tsindv WHERE tsIndvID = ".$id;
			$qry=$dbh->prepare($sql);
			$qry->execute();
			$res=$qry->fetchAll(PDO::FETCH_ASSOC);
			$msgKey=$res[0]['tsIndvFN'].$res[0]['tsIndvLN'];
			
			$sql2="SELECT * FROM tsmsg WHERE tsMsgTo = '".$msgKey."'";
			$qry2=$dbh->prepare($sql2);
			$qry2->execute();
			$res2=$qry2->fetchAll(PDO::FETCH_ASSOC);			

			echo('<table id="tblComp"><tr><th id="col1">From</th><th id="col2">Subject</th><th id="col3">Message</th><th id="col3"></th><th id="col4"></th><th id="col5">Action</th></tr>');
			foreach($res2 as $rf){
				$msgPrim=$rf['tsMsgMsg'];
				if(strlen($msgPrim)>50){
					$msgPrim=substr($msgPrim,0,50).'...';
				}
				$iTable2='<div id="msgReadFrom"><strong>From:</strong><br/>'.$rf['tsMsgFrom'].'</div><br/><div id="msgReadTo"><strong>To:</strong><br/>'.$rf['tsMsgTo'].'</div><br/><div id="msgReadSub"><strong>Subject:</strong><br/>'.$rf['tsMsgSub'].'</div><br/><div id="msgReadMsg"><strong>Message:</strong><br/>'.$rf['tsMsgMsg'].'</div><br/><div id="msgReadDate"><strong>Sent:</strong><br/>'.$rf['tsMsgSentDate'].'</div>';
				echo('<tr><td>'.$rf["tsMsgFrom"].'</td><td>'.$rf['tsMsgSub'].'</td><td>'.$msgPrim.'</td><td>&nbsp;</td><td>'.$rf['tsMsgTo'].'</td><td width=130px><button id="readBut" data-title='.$rf['tsMsgSub'].' value='.$rf['tsMsgId'].'>Read</button><button id="delBut" value='.$rf['tsMsgId'].'>Delete</button></td></tr>');
				echo('<div id="dialog" class="'.$rf['tsMsgId'].'">'.$iTable2.'</div>');			
			}
			echo('</table>');

			?>
		</div> 
	</div>

	<div id="prodInfo">
		<div id="prodInfoLabel"></div>
		<ul id="fList"></ul>
	</div>
</article>
   <nav>
    <ul>
      <li><a href='index.php?cont=logOut'>Log Out</a></li>
      <li><a href='index.php?cont=addProd&ui=<?php echo($_GET['ui']) ?>'>Add Products</a></li>
      <li>Add Users</li>
      <li><a href='index.php?cont=scan&ui=<?php echo($_GET['ui']) ?>'>Product Scanner</a></li>
      <li><a href='index.php?cont=rnew&ui=<?php echo($_GET['ui']) ?>'>Review New Products</a></li>
      <li><a href='index.php?cont=compFnd&ui=<?php echo($_GET['ui']) ?>'>Review Found Products</a></li>
      <li><div id="msgClicker1">Send Message</div></li>
      <li><a href='index.php?cont=msg&ui=<?php echo($_GET['ui']) ?>'>View Messages</a></li>
    </ul>
  </nav>
 
<?php
}
//message 
?>
 <script>
 $(document).ready(function(){
	 $('#mainCont>div>#dialog').dialog({
			autoOpen: false,
			width: 300,
			height: 400,
			show:{
				effect: "fadeIn",
				duration: 1000
				},
			hide: {
				effect: "fadeOut",
				duration: 1000
				}
		});
	 
	 $('#tblComp').delegate('#readBut','click',function(e){
 		var myid = '.'+$(this).val();
		var myTitle = $(this).data('title');
		if($(myid).dialog('isOpen')==false){
			$(myid).dialog('open');
			$(myid).dialog('option','title',myTitle); 
		}
		});  

	 $('#msgDia').dialog({
		 autoOpen:false,
		 width:300,
		 height:40,
		 show:{
			 effect:     "fadeIn",
			 duration:   1000
		 },
	 	 hide:{
		 	 effect:     "fadeOut",
		 	 duration:   1000
	 	 }
	 });

	 $('#tblComp').delegate('#delBut','click',function(e){
			var tIdOut = $(this).val();
			var soPost = $.post('scr/msgDel.php',{so: '1',mId: tIdOut});
				soPost.done(function(data){
					//$('#msgDia').html(data);
					$('#msgDia').dialog('open');
					$('#msgDia').dialog('option','title',data);
					$('#msgDia').dialog('close').delay(300);
					location.reload();
				});
   
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
				location.reload();
			});

	 });
 });
 </script>

