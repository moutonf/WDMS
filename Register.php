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

        <link rel="stylesheet" href="/WDMT/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/WDMT/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/WDMT/assets/css/form-elements.css">
		<link rel="stylesheet" href="/WDMT/assets/css/style.css"> 
		<link rel="stylesheet" href="/WDMT/assets/css/password.css"> 


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
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
		
        <title>Register</title>
    </head>
    <body>
      
	<div class ="top-content">
		<div class ="inner-sm inner-md inner-lg inner-lx">
					<div class ="row">
						<div class ="description">
							<p>
								<h1 style = "font : normal 25px/25px Georgia, sans-serif; color : white ;">Web Defacement Monitoring Tool</h1>	
							</p>
						</div>	
					</div>
			<div class ="container">
				<div class="row">
			       <div class="col-sm-3 col-sm-offset-2 col-md-4 col-md-offset-4">
						<div class="form-box">
								<div class="form-top">
									<div class = "form-top-left">
										<h3>Sign Up!</h3>
										<p>			
											<?php
												if (isset($_SESSION["the_error"]) == NULL && isset($_SESSION["the_error1"]) == NULL && isset($_SESSION["require_pass"]) == NULL)
												{
												   echo	"Enter Your Details Below";
												}
												else
												{
												   if(isset($_SESSION["the_error"]))
												   {
													 echo $_SESSION["the_error"];
												   }
												   else if($_SESSION["the_error1"])
												   {
													 echo $_SESSION["the_error1"];
												   }
												   else
												   {
													 echo $_SESSION["require_pass"];
												   }
												}		
											?>
											
											<?php 
												$_SESSION["the_error"] = NULL;
												$_SESSION["the_error1"] = NULL;
												$_SESSION["require_pass"] = NULL;												
											?>
										</p>
									</div>
									<div class="form-top-right">
										<i class="fa fa-lock"></i>
									</div>
								</div>
								<div class="form-bottom">
										<form name="login" action="/WDMS/API/insertUser" class="login-form" method="POST">																												
											<div class="form-group">
												<label class="sr-only" for="user_fullname">Full names</label>
												<input type="text" required name="user_fullname" placeholder="Full names..." class="form-first-name form-control" id="user_fullname">
											</div>

											<div class="form-group">
												<label class="sr-only" for="form-email">Email</label>
												<input type="text" required name="user_email" placeholder="Email..." class="form-email form-control" id="user_email">
											</div>
											
											<div class="form-group">
												<section>
													<label class="sr-only" for="user_password">Password</label>
													<input type="password" required name="user_password" placeholder="Password..." class="form-email form-control" id="user_password" >
													<meter  max="4" id="password-strength-meter"  class="no-appearance"></meter>
													<p id="password-strength-text"></p>
												</section>
											</div>
											
											<div class="form-group">
												<label class="sr-only" for="user_passwordconf">Password</label>
												<input type="password" required name="user_passwordconf" placeholder="Confirm Password..." class="form-password form-control" id="user_passwordconf">
											</div>
											
											<button type="submit" class="btn">Sign Up</button>
										</form>	
										<center>
											<a href = "index.php"> Log In </a>
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
        				<p>By CSIR VACWORK STUDENTS at <a href="http://defsec.csir.co.za/" target="_blank"><strong>CCIW UNIT</strong></a> 
        				<i class="fa fa-smile-o"></i></p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript --> 

		<script src="/WDMT/assets/js/jquery-1.11.1.min.js"></script>
		<script src="/WDMT/assets/js/scripts.js"></script> 
        <script src="/WDMT/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/WDMT/assets/js/jquery.backstretch.min.js"></script>
		
		             
    </body>
</html>