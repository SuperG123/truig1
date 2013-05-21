<?php
$uid=str_getcsv(base64_decode($_GET['ui']));
if($uid[0]==1 && $uid[2]==1){
	echo(supUser());
}else if($uid[0]==1 && $uid[2]==0){
	echo('Your credientials you not allow you access to this page.');
}else{
	echo('login error.');
}

function supUser(){
	?>
<article>
	<div id="mainCont">
		<div if="compDat">
			<p>Review Found Products</p>
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

			//$inSku = 'DW8250';
			//retrieve data
			$sql="SELECT tsFndId,tsFndSku,tsFndSrcSku,tsFndLoc,tsFndCt,tsFndAltPrice1 FROM tsfnd";
			$qry=$dbh->prepare($sql);
			$qry->execute();
			$res=$qry->fetchAll(PDO::FETCH_ASSOC);
			echo('<table id="tblComp"><tr><th id="col1">SKU</th><th id="col2">Source 1</th><th id="col3">Source 2</th><th id="col3">Source 3</th><th id="col4">Source 4</th><th id="col5">Source 5</th></tr>');
			foreach($res as $rf){
				echo('<tr><td><button id="killBut" value="'.$rf['tsFndId'].'">X</button>'.$rf["tsFndSku"].'</td>');

				$sp1=$dbh->prepare("SELECT * FROM tsdat WHERE tsSku = :sku");
				$sp1->execute(array(':sku'=>$rf['tsFndSku']));
				$sp1Res=$sp1->fetchAll(PDO::FETCH_ASSOC);
				
				$colCt=0;
				foreach($sp1Res as $spu){
					
					
					$iTable2='<div id="iTo4">SKU<br/>'.$spu['tsSku'].'</div><div id="iTo4">UPC<br/>'.$spu['tsUpc'].'</div><div id="iTo4">Source<br/>'.$spu['tsSource'].'</div><div id="iTo4">Vendor Num<br/>'.$spu['tsVendNum'].'</div><br/><div id="iTo4">Cost<br/>'.$spu['tsCost'].'</div><div id="iTo4">Price<br/>'.$spu['tsPrice'].'</div><div id="iTo4">Units<br/>'.$spu['tsUnit'].'</div><div id="iTo4">Order X<br/>'.$spu['tsOM'].'</div><br/><div id="iTo4">Cata 1<br/>'.$spu['tsCata1'].'</div><div id="iTo4">Cata2<br/>'.$spu['tsCata2'].'</div><div id="iTo4">Cata 3<br/>'.$spu['tsCata3'].'</div><div id="iTo4">Cata 4<br/>'.$spu['tsCata4'].'</div><br/><div id="iTo2">Description 1<br/>'.$spu['tsDesc1'].'</div><br/><div id="iTo2">Description 2<br/>'.$spu['tsDesc2'].'</div><br/><div id="iTo2">TT Price<br/>'.$rf['tsFndAltPrice1'].'</div>';
					echo('<td><button id=selBut value='.$spu['tsId'].'>'.$spu['tsId'].'--></button><button id="infoBut" value='.$spu['tsId'].'>'.$spu['tsSource'].'</button></td>');
					echo('<div id="dialog" class="'.$spu['tsId'].'">'.$iTable2.'</div>');
					$colCt++;
				}
			
			$eCol = ($colCt+1);
			if($eCol <= 5){
				for($i=$eCol;$i<6;$i++){
					echo('<td>&nbsp;</td>');
				}
				echo('</tr>');
			}else{
				echo('</tr>');
			}
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
?>
 <script>
 $(document).ready(function(){
	 $('#mainCont>div>#dialog').dialog({
			autoOpen: false,
			width: 665,
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
	 
	 $('#tblComp').delegate('#infoBut','click',function(e){
 	 	//alert('but fire');

 		var myid = '.'+$(this).val();
 		//alert($(this).val());
		var myTitle = 'info';
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

	 $('#tblComp').delegate('#selBut','click',function(e){
			var tIdOut = $(this).val();
//alert(tIdOut);
			var soPost = $.post('scr/sendOut.php',{so: '1',tId: tIdOut});
				soPost.done(function(data){
					//$('#msgDia').html(data);
					$('#msgDia').dialog('open');
					$('#msgDia').dialog('option','title',data);
					$('#msgDia').dialog('close').delay(300);
				});
	 });
	 
	//Delete Record
	 $('body').on('click','#killBut',function(e){
	 	var mId=$(this).val();
	 	$('body').append('<div id="utilDialog"></div>');
	 	$('#utilDialog').dialog({
	 		dialogClass: 'no-close',
	 		modal:true,
	 		title:"Do you really want to delete this record?",
	 		buttons:[
	 		         {
	 			     	text: "DELETE",
	 			     	click: function(){
		 			     	var delPost = $.post('scr/sendOut.php',{'so':3,'tbl':'tsfnd','col':'tsFndId','colId':mId});
		 			     		delPost.done(function(data){

			 			    		location.reload();
		 			     		});
	 			     	}},
	 			     	{
	 			     text: "NO!",
	 			     click: function(){
	 				     alert('Your record has not been deleted.');
	 				     $(this).dialog('close');
	 			     }
	 		     }]
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
			});

	 });	 
 });
 </script>

