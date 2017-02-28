<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <a href = "intranet.php"> <img src="images/123.png"class="img-rounded" width="300" height="130"/></a>
        <style>.img-rounded</style>
		
       

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <!--<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">-->
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
		
        <title>Delete</title>
    </head>
    <body>
	<?php
	
	 session_start();   //starting the session
                            if(!$_SESSION['admin']){
								header('Location: admin');
                            }
	
			$servername = "127.0.0.1";
			$username = "root";
			$password = "";
			$dbname = "academycity";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}						
		?>
        <div class ="top-content">
            <div class ="inner-bg" style = "padding: 12px 100px 100px 100px;">
				<div class ="row">
					<div class ="description">
						<p>
							<h1 style = "font : normal 25px/25px Georgia, sans-serif; color : white ;">Web Defacement Monitoring Tool</h1>	
						</p>
					</div>	
				</div>
                <div class ="container">
					<div class="row">
						<div class="col-sm-5">
							<div class="form-box">
								<div class="form-top">
	                        		<div class = "form-top-left">
	                        			<h3>Admin Management</h3>
	                            		
	                        		</div>
									<div class="form-top-right">
	                        			<a href="http://146.64.213.31/WDMS/Bokang/intranet.php"><i class="fa fa-backward"></i></a>
										<a href="http://146.64.213.31/WDMS/Bokang/delete.php"><i class="fa fa-refresh"></i></a>
	                        		</div>
									<div class="">
									<form class = "form-control">
									
									</form >
										<form name="view" action="delete.php" method="POST">
											
											<div class = "styled-select blue semi-square" style = "padding: 3px 185px 4px 5px; margin: 5px 5px 5px 5px; " style = "">
												<select id = "bk" name="email">
												<option value="default">Select an option</option>
												<?php 
													$conn2 = new mysqli($servername, $username, $password, $dbname);
													$query2 ="SELECT user_email FROM USERS";
													$result = mysqli_query($conn2,$query2);
													while (@$row = mysqli_fetch_row($result)){
													echo "<option value =".  $row[0] .">" . $row[0] . "</option>";
													}

												?>
											
										</select><br>
										<br>
										</div>
										
										<!--<button type="submit" name="btnView" value="View" class = "btn">-->
										
											<button type="submit" name="btnSelectUser" class="btn" "padding: 5px 500px 2px 500px;">Search Domains</button><br/>	
											
										</form>
										
										</div>
										
	                        		
	                            </div>
								<div class="form-bottom">
									
											
										
                        

                    
					
					<?php
	
													if ($_SERVER['REQUEST_METHOD'] === 'POST') {
													//something posted
													
													if (isset($_POST['btnSelectUser'])) {
														// btnView
													
													$conn2 = new mysqli($servername, $username, $password, $dbname);
													$query2 ="SELECT ip_address FROM USERFILE WHERE user_email = '". $_POST['email']."'";
													$result = mysqli_query($conn2,$query2);
													while (@$row = mysqli_fetch_row($result)){
															//var_dump($row[2])."\r\n";
														   //taking data from database to views the form table
														
																		  
													}
													}
													
																																	  
													?>


									<form name="deleteForm" action="http://146.64.213.31/WDMS/Bokang/delete.php" method="POST">

									<div class = "" style = "">
												<select name="ip_address" class = "textarea form-control">
												<option value="default">Default</option>
												<?php 
													$conn2 = new mysqli($servername, $username, $password, $dbname);
													$query2 ="SELECT ip_address FROM USERFILE WHERE  user_email = '". $_POST['email']."'";
													$result = mysqli_query($conn2,$query2);
													while (@$row = mysqli_fetch_row($result)){
													echo "<option value =".  $row[0] .">" . $row[0] . "</option>";
													}

												?>
											
										</select><br>
										<br>
										</div>
										<button type="submit" name="btnDelete" class="btn" "padding: 5px 500px 2px 500px;">Delete Domain</button>	
										</form>
										
										<?php
										
										if (isset($_POST['btnDelete'])) {
														// btnView
													$_POST['ip_address'] . '<br/>';
													echo "Domain deleted!";
																										
													$conn2 = new mysqli($servername, $username, $password, $dbname);
													$query3 ="DELETE FROM USERFILE WHERE ip_address = '". $_POST['ip_address']."'";
													$result = mysqli_query($conn2,$query3);
													
													 if(! $result ) {
													   die('Could not delete data: ' . mysql_error());
													}
													
													
													@mysql_close($conn2);
													
													}
																						}
													
													
										?>
										
										
							</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<form action="146.64.213.31/WDMS/bokang/API/Logout" method="POST">
			<button type="submit" class="btn" style = "padding: 5px 100px 2px 100px;">Log Out</button>
		</form>
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
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		
						
                      
    </body>
</html>