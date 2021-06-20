<main>
	<?php
	session_start();
   
	$rol = $_SESSION['rol'];
	if($rol=="PASAJERO"){
		header("location: ../Vista/viewReception");
	 }else if($rol=="RECEPCIONISTA"){
		header("location: ../Vista/viewReception");
	 }

	?>
	<div class="error">
		<span>Invalid data entry, please try again</span>
	</div>

    <img class="wave" src="/Resources/Images/wave.svg">
	
	<div class="container">
		<div class="img">
			<img src="/Resources/Images/background_login.svg">
		</div>

		<div class="login-content">
			
			<form name="frmLogin" method="POST" action="..Servidor/index.php">
				<img class="avatar" src="/Resources/Images/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input id="userLog" name="usuariolg" autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" class="input" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input id="passLog" name="passlg" type="password" class="input" required>
            	   </div>
            	</div>
            	<input id="btn_login" type="submit" class="btn" value="ACCESS" name="btn_login">
            </form>
        </div>
    </div>


    <script type="text/javascript" src="http://127.0.0.1:9000/Resources/JS/login.js"></script>
</main>