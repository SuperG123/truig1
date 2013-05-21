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
		<form enctype="multipart/form-data">
			<p>upload form will be here</p>
			<div id="fUp">
			<label for="fileUp">UPC</label><br/>
			<input type="file" size="10" id="file" name="file" autofocus />
			</div>
			<div id="fSrc">
			<label for="fileSource">Vendor Source</label><br/>
			<input type="text" size="10" id="fileSource" name="fileSource" />
			</div>
			<div id="sender">
			<br/>
			<button type="button" id="sendBut">Add Product</button>
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
      <li><div id="msgClicker">Send Message</div></li>
    </ul>
  </nav>
 
<?php
}
?>
 <script>
 $(document).ready(function(){
    $('form').delegate('#sendBut','click',function(e){
 		var formData = new FormData($('form')[0]);
		$.ajax({
			url: 'scr/dataIn.php?f=saveDat',
			type: 'POST',
			xhr: function() {
				myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
				}
				return myXhr;
			},
			//Ajax events
			//beforeSend: beforeSendHandler,
			success: completeHandler,
			error: errorHandler,
			// Form data
			data: formData,
			//Options to tell JQuery not to process data or worry about content-type
			cache: false,
			contentType: false,
			processData: false	
		});
	});
	function completeHandler(data){
		$('#prodInfoLabel').html('<p>File has been saved</p>');
	}	
	function errorHandler(data){
		alert("upload error.");
		}
	function progressHandlingFunction(e){
		if(e.lengthComputable){
			$('pregress').show();
    		$('progress').attr({value:e.loaded,max:e.total});
 		}
	}
	//send message
	 $('nav ul li').delegate('#msgClicker','click',function(e){
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