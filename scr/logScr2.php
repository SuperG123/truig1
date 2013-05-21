<?php
$uid=str_getcsv(base64_decode($_GET['ui']));
if($uid[0]==1 && $uid[2]==1){
	echo(supUser());
}else if($uid[0]==1 && $uid[2]==0){
	echo(regUser());
}else{
	echo('login error.');
}

function regUser(){
?>
<article>
	<div id="mainCont">
		<div id="mainForm">
			<div id="fUpc">
			<label for="sUpc">UPC</label><br/>
			<input type="text" size="10" id="sUpc" name="sUpc" autofocus />
			</div>
			<div id="fSku">
			<label for="sSku">SKU</label><br/>
			<input type="text" size="10" id="sSku" name="sSku" />
			</div>
			<div id="fQty">
			<label for="sQty">Qty</label><br/>
			<input type="text" size="10" id="sQty" name="sQty" />
			</div>
			<div id="fLoc">
			<label for="sLoc">Loc</label><br/>
			<input type="text" size="10" id="sLoc" name="sLoc" />
			</div>
			<div id="fTtp">
			<label for="sTtp">TT Price</label><br/>
			<input type="text" size="10" id="sTtp" name="sTtp" />
			</div>
			<div id="clicker">
			<br/>
			<button type="button" id="logBut">Find Product</button>
			<button type="button" id="canBut">Cancel</button>
			</div>
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
      <li><a href='index.php?cont=msg&ui=<?php echo($_GET['ui']) ?>'>View Messages</a></li>
    </ul>
  </nav>
 
<?php

}
function supUser(){
?>
<article>
	<div id="mainCont">
		<form id="mainForm">
			<div id="fUpc">
			<label for="sUpc">UPC</label><br/>
			<input type="text" size="10" id="sUpc" name="sUpc" autofocus />
			</div>
			<div id="fSku">
			<label for="sSku">SKU</label><br/>
			<input type="text" size="10" id="sSku" name="sSku" />
			</div>
			<div id="fQty">
			<label for="sQty">Qty</label><br/>
			<input type="text" size="10" id="sQty" name="sQty" />
			</div>
			<div id="fLoc">
			<label for="sLoc">Loc</label><br/>
			<input type="text" size="10" id="sLoc" name="sLoc" />
			</div>
			<div id="fTtp">
			<label for="sTtp">TT Price</label><br/>
			<input type="text" size="10" id="sTtp" name="sTtp" />
			</div>
			<div id="clicker">
			<br/>
			<button type="button" id="logBut">Find Product</button>
			<button type="button" id="canBut">Cancel</button>
			</div>
		</form> 
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

//validation tests
$('#mainForm input').on('focus',function(){
//	vTest();
});
$('#mainForm').on('keypress','input',function(){
//	vTest();
});

function vTest(){
	var vCt = $('#mainForm input:valid').length;
	var iCt = $('#mainForm input').length;
	var vDiff = iCt - vCt;
	if (vDiff == 0){
		$('button').removeAttr('disabled');
		$('#mainForm>#saver1').show();
		
	}else{
		//$('#mainForm>#saver1').attr('disabled','disabled');
		$('#mainForm>#saver1').hide();
	}
}
//---------------------------------------------->>
 
  $('#logBut').click(function(){
		var su = $('#sUpc').val();
		var ss = $('#sSku').val();
		var rStat = '';

		$.getJSON('scr/sProd.php',{'sku':ss,'upc':su})
			.done(function(data){
				var items=[];
				$.each(data,function(key,val){
					if(key=='error'){rStat='notFound';}
					items.push('<li id="'+key+'">'+key+':  '+val+'</li>');
					if(key=='SKU'){$('#sSku').val(val);}
					if(key=='srcSku'){$('#mainForm').append('<input type="hidden" id="srcSku" name="srcSku" value="'+val+'" />');}
					if(key=='UPC'){$('#sUpc').val(val);}

				});
				if(rStat=='notFound'){
					$('#prodInfoLabel').html('<hr/>Product Not Found:');
					$('#fList').html('Please complete the form above and save the new product.');
					$('#mainForm #clicker').hide(); //hide find button in prep for save button
					$('#mainForm #cancel').hide();
					$('#mainForm #sSku').attr('required','required').focus();
					$('#mainForm #sQty').attr('required','required');
					$('#mainForm #sLoc').attr('required','required');
					$('#mainForm #sTtp').attr('required','required');
					$('#mainForm').append('<div id="fPr"><label for="sPr">Price</label><br/><input type="text" size="10" id="sPr" required  /></div>');
					$('#mainForm').append('<div id="fCo"><label for="sCo">Cost</label><br/><input type="text" size="10" id="sCo" required  /></div>');
					$('#mainForm').append('<div id="fDe"><label for="sDe">Description</label><br/><input type="text" size="10" id="sDe" required  /></div>');
					$('#mainForm').append('<div id="fCa"><label for="sCa">Category</label><br/><input type="text" size="10" id="sCa" required  /></div>');
					$('#mainForm').append('<div id="fWe"><label for="sWe">Weight</label><br/><input type="text" size="10" id="sWe" required  /></div>');
					$('#mainForm').append('<div id="fDi"><label for="sDi">Dimentions</label><br/><input type="text" size="10" id="sDi" required  /></div>');
					$('#mainForm').append('<div id="fVe"><label for="sVe">Vendor</label><br/><input type="text" size="10" id="sVe" required  /></div>');
					$('#mainForm').append('<div id="saver1"><br/><button type="button" id="saveBut">Save Product</button></div>');
					$('#mainForm').append('<div id="cancel1"><br/><button type="button" id="canBut">Cancel</button></div>');
					vTest();
				}else{
					$('#clicker').hide();
					$('#mainForm #sQty').attr('required','required').focus();
					$('#mainForm #sLoc').attr('required','required');
					$('#mainForm #sTtp').attr('required','required');
					$('#mainForm').append('<div id="saver1"><br/><button type="button" id="saveBut1">Save Product</button></div>');
					$('#mainForm').append('<div id="cancel1"><br/><button type="button" id="canBut">Cancel</button></div>');
					$('#prodInfoLabel').html('<hr/>Product Found:');
					$('#fList').html('A product was found. If the information below is correct please enter the current quantity and location code then click the save Product Button.<br/><br/>');
					$('#fList').append(items.join(''));
				}
  		});
  });

  $('#mainForm').delegate('#canBut','click',function(e){
		location.reload();
  });
  $('#mainForm').delegate("#saveBut","click",function(e){
	   var UPC    = $('#sUpc').val();
	   var SKU    = $('#sSku').val();
	   var QTY    = $('#sQty').val();
	   var LOC    = $('#sLoc').val();
	   var PRICE  = $('#sPr').val();
	   var DESC   = $('#sDe').val();
	   var CATA   = $('#sCa').val();
	   var WEIGHT = $('#sWe').val();
	   var DIMS   = $('#sDi').val();
	   var VEND   = $('#sVe').val();
	   var TTP    = $('#sTtp').val();

	   $.getJSON('scr/sProdSave.php',{'upc':UPC,'sku':SKU,'qty':QTY,'loc':LOC,'price':PRICE,'desc':DESC,'cata':CATA,'weight':WEIGHT,'dims':DIMS,'vend':VEND,'ttp':TTP})
	   	.done(function(data){
			location.reload();
		   	/*$.each(data,function(key,val){
			   	if(key=='saved'){
				   	$('#mainForm #clicker').show();
				   	$('#mainForm #saver').remove();
				   	$('#mainForm #fPr').remove();
				   	$('#mainForm #fDe').remove();
				   	$('#mainForm #fCa').remove();
				   	$('#mainForm #fWe').remove();
				   	$('#mainForm #fDi').remove();
				   	$('#mainForm #fVe').remove();
				   	$('#sUpc').val('');
				   	$('#sSku').val('');
				   	$('#sQty').val('');
				   	$('#sLoc').val('');
				   	$('#sTtp').val('');
					$('#prodInfoLabel').html('<hr/>New Product Saved:');
					$('#fList').html('The new product has been successfully saved.<br/> You may now scan the next product.');
			   	}else if(key=='error'){
				   	//do error proc//
			   		$('#prodInfoLabel').html('<hr/>An error has occured:');
					$('#fList').html('While attempting to save the new product an error was encountered.<br/>Please send the SKU or UPC of the product to you supervisor.');
			   	}else{
				   	//do null proc//
				   	alert('Error... please contact Eric.');
			   	}
		   	});
		   	*/
	   	});
  });

  $('#mainForm').delegate('#saveBut1','click',function(e){
	  var UPC    = $('#sUpc').val();
	  var SKU    = $('#sSku').val();
	  var QTY    = $('#sQty').val();
	  var LOC    = $('#sLoc').val();
	  var TTP    = $('#sTtp').val();
	  var SSK	 = $('#srcSku').val();

	  $.getJSON('scr/sProdSave1.php',{'upc':UPC,'sku':SKU,'qty':QTY,'loc':LOC,'ttp':TTP,'ssk':SSK})
			  .done(function(data){
				  alert(SSK+' is the srcSku');
				  //location.reload();
					/*$.each(data,function(key,val){
						if(key=='saved'){
							$('#mainForm #clicker').show();
						   	$('#mainForm #saver1').remove();
						   	$('#sUpc').focus().val('');
						   	$('#sSku').val('');
						   	$('#sQty').val('');
						   	$('#sLoc').val('');
						   	$('#sTtp').val('');
							$('#prodInfoLabel').html('<hr/>New Product Saved:');
							$('#fList').html('The new product has been successfully saved.<br/> You may now scan the next product.');
						}else if(key=='error'){
							$('#prodInfoLabel').html('<hr/>An error has occured:');
							$('#fList').html('While attempting to save the new product an error was encountered.<br/>Please send the SKU or UPC of the product to you supervisor.');
						}else{
							alert('Error... please contact Eric');
						}
						
					});*/
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
  </script>