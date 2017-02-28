<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
	
	<script type="text/javascript" src="/jquery/jquery-latest.js"></script> 
	<script type="text/javascript" src="/jquery/jquery.tablesorter.js"></script> 
	<script src="sorttable.js"></script>
	<style>
/* Sortable tables */
table.sortable thead {
    background: rgba(54, 25, 25, .2);
    font-weight: bold;
    cursor: default;
}
</style>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <img src="images/123.png"class="img-rounded" width="300" height="130"/>
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
		
        <title>Home</title>
		<?php
		session_start();   //starting the session
                            if(!$_SESSION['csir']){
								header('Location: index.php');
                            }

                            $logged_in_person = $_SESSION['csir'];
							
							 $FileID= "";
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
    </head>
    <body>
        <div class ="top-content">
            <div class ="inner-bg" style = "padding: 12px 100px 50px 100px;">
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
	                        			<h3>Activities for <b><?php echo $logged_in_person?> </b></h3>
	                            		
	                        		</div>
	                        		<div class="form-top-right">
	                        			<!--<i class="fa fa-info-circle"></i>-->
										<a href="http://146.64.213.31/WDMS/Bokang/Home.php"><i class="fa fa-refresh"></i></a>
	                        		</div>
	                            </div>
								<div class="form-bottom">
								
									
									<form name="home" action="http://146.64.213.31/WDMS/Bokang/API/Logout" class="login-form" method="POST">
											
										
                        <table style = "border: inset 1px black; width: 100%" name="myTable" class="sortable">
                            <thead>
                              <tr style = "color: #00bfff ; width: 100%; font-weight: 200%">

                                    <th>Domain Name</th>
									<th>File Name</th>
									<th>File Status</th>
                                    <th>Last Modified</th>
									<th>Action</th>
                              </tr>
							  </thead>
							  <tbody>

                            <?php
							
							$conn2 = new mysqli($servername, $username, $password, $dbname);
                            $query2 ="SELECT * FROM USERFILE WHERE user_email = '".$GLOBALS['logged_in_person']."' ";
                            $result = mysqli_query($conn2,$query2);
                            while (@$row = mysqli_fetch_row($result)){
                                //var_dump($row[2])."\r\n";
                               //taking data from database to views the form table
                              $FileID=$row[0];
							  $field=$row[4];
                              //$colour=$row[11];
                              echo "<tr class ='' style = 'color : 	#f5f4c4	;font-size: 14px;'>";
                              echo"<th>";

                              echo $row[11];
                              echo"</th><th>";
                              echo $row[1];
                              echo"</th><th>";
							  
										if($field == "0")
										{
											echo '<img src="images/circle-xxl.png" alt="" width="15" height="15"/>';
										}
										if($field == "1")
										{
											echo '<img src="images/yellow.png" alt="" width="15" height="15"/>';
										}
										if($field == "2")
										{
											echo '<img src="images/red.png" alt="" width="15" height="15"/>';
										}
									
									
                              //echo $row[4];
                              echo"</th><th>";
							 
                              echo $row[6];
							   echo"</th><th>";
                              echo"<a href=moreinfo.php?UserFileID=$FileID>More Info</a>";
                              echo "</th></tr>";
							     }
							
                            $conn->close();
                            ?>
							</tbody>
			
            </table> 
									
										
									</form>				
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<form action="http://146.64.213.31/WDMS/Bokang/API/Logout" method="POST">
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