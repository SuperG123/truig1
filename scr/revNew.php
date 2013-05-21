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
			<p>Review New Products</p>
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
			//retrieve data
			$sql="SELECT * FROM tsnew";
			$qry=$dbh->prepare($sql);
			$qry->execute();
			$res=$qry->fetchAll(PDO::FETCH_ASSOC);
			echo('<table id="tblComp"><tr><th id="col1">SKU</th><th id="col2">UPC</th><th id="col3">Cost</th><th id="col3">TT Price</th><th id="col4">Price</th><th id="col5">Action</th></tr>');
			foreach($res as $rf){
				$iTable2='<div id="iTo4">SKU<br/>'.$rf['tsNewSku'].'</div><div id="iTo4">UPC<br/>'.$rf['tsNewUpc'].'</div><div id="iTo4">Vendor<br/>'.$rf['tsNewVendor'].'</div><div id="iTo4">Cost<br/>'.$rf['tsNewCost'].'</div><br/><div id="iTo4">Price<br/>'.$rf['tsNewPrice'].'</div><div id="iTo4">TT Price<br/>'.$rf['tsNewAltPrice1'].'</div><div id="iTo4">Qty<br/>'.$rf['tsNewCt'].'</div><div id="iTo4">Location<br/>'.$rf['tsNewLoc'].'</div><div id="iTo4">Weight<br/>'.$rf['tsNewWeight'].'</div><br/><div id="iTo4">Dims<br/>'.$rf['tsNewDims'].'</div><div id="iTo4">Cata1<br/>'.$rf['tsNewCata'].'</div><div id="iTo4">Description<br/>'.$rf['tsNewDesc'].'</div>';
				$iTable3='<div id="'.$rf['tsNewId'].'e"><div id="ne1">SKU<br/><input type="text" id="nsSku" name="nsSku" value="'.$rf['tsNewSku'].'" required /></div><div id="ne1">UPC<br/><input type="text" id="nsUpc" name="nsUpc" value="'.$rf['tsNewUpc'].'" required /></div><div id="ne1">Vendor Number<br/><input type="text" id="nsVendor" name="nsVendor" value="'.$rf['tsNewVendor'].'" required /></div><div id="ne1">Cost<br/><input type="text" id="nsCost" name="nsCost" value="'.$rf['tsNewCost'].'" required /></div><br/><div id="ne1">Price<br/><input type="text" id="nsPrice" name="nsPrice" value="'.$rf['tsNewPrice'].'" required /></div><br/><div id="ne1">TT Price<br/><input type="text" id="nsTtp" name="nsTtp" value="'.$rf['tsNewAltPrice1'].'" required /></div><div id="ne1">Qty<br/><input type="text" id="nsQty" name="nsQty" value="'.$rf['tsNewCt'].'" required /></div><div id="ne1">Location<br/><input type="text" id="nsLoc" name="nsLoc" value="'.$rf['tsNewLoc'].'" required /></div><div id="ne1">Weight<br/><input type="text" id="nsWeight" name="nsWeight" value="'.$rf['tsNewWeight'].'" required /></div><br/><div id="ne1">Dims<br/><input type="text" id="nsDims" name="nsDims" value="'.$rf['tsNewDims'].'" required /></div><div id="ne1">Cata1<br/><input type="text" id="nsCata1" name="nsCata1" value="'.$rf['tsNewCata'].'" required /></div><div id="ne1">Description<br/><input type="text" id="nsDesc" name="nsDesc" value="'.$rf['tsNewDesc'].'" required /></div></div>';
				
				echo('<tr><td>'.$rf["tsNewSku"].'</td><td>'.$rf['tsNewUpc'].'</td><td>'.$rf['tsNewCost'].'</td><td>'.$rf['tsNewAltPrice1'].'</td><td>'.$rf['tsNewPrice'].'</td><td width=250px><button id="selBut" value='.$rf['tsNewId'].'>Select</button><button id="detailBut" value='.$rf['tsNewId'].'>Details</button><button id="delBut" value='.$rf['tsNewId'].'>Delete</button><button id="editBut" data-me ='.$rf['tsNewId'].'e>Edit</button></td></tr>');
				echo('<div id="dDialog" class="'.$rf['tsNewId'].'v">'.$iTable2.'</div>');			
				echo('<div id="eDialog" class="'.$rf['tsNewId'].'e">'.$iTable3.'</div>');
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
 <div id="utilDialog"></div>
<?php
}
//message 
?>
 <script>
 $(document).ready(function(){
	 $('#mainCont>div>#dDialog').dialog({
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
	 
	 $('#tblComp').delegate('#detailBut','click',function(e){
 		var myid = '.'+$(this).val()+'v';
		var myTitle = 'New Product Details';
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
			var soPost = $.post('scr/sendOut.php',{so: '2',tId: tIdOut});
				soPost.done(function(data){
					$('#msgDia').dialog('open');
					$('#msgDia').dialog('option','title',data);
					$('#msgDia').dialog('close').delay(300);
					if(data = 'Record Created'){
						location.reload();
					}
				}); 
	 });

//Delete Record
$('#tblComp').on('click','#delBut',function(e){
	var mId=$(this).val();
	$('#utilDialog').dialog({
		dialogClass: 'no-close',
		modal:true,
		title:"Do you really want to delete this record?",
		buttons:[
		         {
			     	text: "DELETE",
			     	click: function(){
				    	alert('delete function');
				    	var delNew = $.post('scr/newDel.php',{'mId':mId});
				    		delNew.done(function(data){
					    		$('#utilDialog').dialog('option','title','Record Deleted');
					    		$('#utilDialog').dialog('close').delay(500);
					    		location.reload();
				    		});
			     	}},
			     	{
			     text: "NO!",
			     click: function(){
				     alert('record not deleted');
				     $(this).dialog('close');
			     }
		     }]
	});
		         	
});

//Edit new product
$('#mainCont>div>#eDialog').dialog({
			dialogClass:'no-close',
			autoOpen:false,
			width: 800,
			height:350,
			show:{effect:"fadeIn",duration:1000},hide:{effect:"fadeOut",duration:1000},
	});

$('#tblComp').on('click','#editBut',function(e){
	var mId = '.'+$(this).data('me');
	var m2 = '#'+$(this).data('me');
	var m1 = $(this).data('me').substr(0,$(this).data('me').length-1);
	//alert(m1);
	$(mId).dialog('open');
	$(mId).dialog('option','title','Edit - New Product');
	$(mId).dialog('option','buttons',[{
			text:"Save",
			click:function(){
	//alert($(m2+' input#nsSku').val());

				var sId=m1;
				var sku=$(m2+' #nsSku').val();
				var upc=$(m2+' #nsUpc').val();
				var vend=$(m2+' #nsVendor').val();
				var cost=$(m2+' #nsCost').val();
				var price=$(m2+' #nsPrice').val();
				var qty=$(m2+' #nsQty').val();
				var loc=$(m2+' #nsLoc').val();
				var weight=$(m2+' #nsWeight').val();
				var dims=$(m2+' #nsDims').val();
				var cata=$(m2+' #nsCata1').val();
				var desc=$(m2+' #nsDesc').val();
				var ttp=$(m2+' #nsTtp').val();
				var saveEdit = $.post('scr/newEditSave.php',{'sId':sId,'nsSku':sku,'nsUpc':upc,'nsVendor':vend,'nsCost':cost,'nsPrice':price,'nsQty':qty,'nsLoc':loc,'nsWeight':weight,'nsDims':dims,'nsCata1':cata,'nsDesc':desc,'nsTtp':ttp});
					saveEdit.done(function(data){
						$('#mainCont>div>#eDialog').dialog('option','title','Record Updated');
						$('#mainCont>div>#eDialog').dialog('close').delay(500);
						location.reload();
					});
	
			}},
			{
			text:"Cancel",
			click:function(){
				$(this).dialog('close');
			}}]);
	
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

	//validation tests
/*	 $('input').on('focus',function(){
	 	vTest();
	 });
	 $('input').on('change',function(){
	 	vTest();
	 });
	 function vTest(){
	 	var vCt = $('input:valid').length;
	 	var iCt = $('input').length;
	 	var vDiff = iCt - vCt;
	 	alert(vDiff);
	 	if (vDiff == 0){
		 	$('button').attr('enabled','enabled');
		 	alert('fire');	 		
	 	}else{
	 		$('button').attr('disabled','disabled');
	 	}
	 }
*/	 
 });
 </script>

