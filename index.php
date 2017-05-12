<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <img src="images/123.png"class="img-rounded" width="300" height="130"/>
        <style>.img-rounded</style>
		
       

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
		

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
		
		

	
		
    <title>Login</title>
    </head>
    <body>
        <div class ="top-content">
			<div class ="row">											
						<div class ="description">
							<p>
								<h5 style = "font : normal 25px/25px Georgia, sans-serif; color : white ;">Web Defacement Monitoring Tool</h5>	
							</p>
						</div>							
			</div>
				<div class ="inner-sm inner-md inner-lg inner-xl" >
					<div class ="container" >	
						<div class="col-sm-5 col-sm-offset-4 col-md-4 col-md-offset-3">
							<div class="row">
								<div class="form-box">
									<div class="form-top">
										<div class="form-top-left">
											<h3>Login</h3>
											<p>	
												<?php
													if (isset($_SESSION["error"]) == NULL)
													{
													   echo	"Enter Email address and Password";
													}
													else
													{
													   echo $_SESSION["error"];
													}
												?>
												
												<?php 
													$_SESSION["error"] = NULL;
												?>
											</p>
										</div>
										<div class="form-top-right">
											<i class="fa fa-lock"></i>
										</div>
									</div>
									<div class="form-bottom">
										<form name="login" action="/WDMS/API/login" class="login-form" method="POST">
											<div class ="form-group">
												<label for="user_email" class="sr-only">E-mail</label>
												<input type="text" id ="user_email" required name="user_email" value="" class ="form-username form-control" placeholder="Enter your email" onblur="validate()" /> <!--- Email input box--->								
											</div>
											
											<div class ="form-group">
												<label for="user_password" class="sr-only">Password</label>
												<input type="password" id ="user_password" required name="user_password" value="" class ="form-password form-control" placeholder="Enter your password" onblur="validate()"/> <!--- Password input box--->								
											</div>
											
											<button type="submit" class="btn">Log In</button> 
											
										</form>
										<center>
										<a href = "Register.php"> Sign Up Now! </a>
										</center>
									</div>
								</div>
							</div>
						
						</div>
						
					</div>
				</div>
		</div>
		
		
		 <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p>Made by CSIR VACWORK STUDENTS at <a href="http://defsec.csir.co.za/" target="_blank"><strong>CCIW UNIT</strong></a> 
        					<i class="fa fa-smile-o"></i></p>
        			</div>
        			
        		</div>
        	</div>
        </footer>
		

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		
						
                      
    </body>
</html>