		<article>
		<div id="mainCont">
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
		</div>
	</article>
  <nav>
    <ul>
      <li>About</li>
      <li>Service</li>
      <li>Contact</li>
    </ul>
  </nav>
		
		<script>
			$('#logBut').click(function(event){
				$("#mainCont").append("<hr/>We will now log you in.<hr/>");
				var usr=$('#user').val();
				var pas=$('#pass').val();
				$.post("scr/logScr2.php",{m: 'main',u:usr,p:pas})
					.done(function(data){
					$("#mainBody").html(data);
				});
			});
		</script>