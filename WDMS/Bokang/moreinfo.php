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
		
        <title>More Info</title>
		<?php
		 session_start();   //starting the session
                            if(!$_SESSION['csir']){
								header('Location: index.php');
                            }
							$file_name = "";	
							
							$userfile_id = $_REQUEST['UserFileID'];
					
							

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
							$conn2 = new mysqli($servername, $username, $password, $dbname);
                            $query2 ="SELECT * FROM USERFILE WHERE userfile_id = '".$userfile_id."'";
                            $result = mysqli_query($conn2,$query2);
                            while (@$row = mysqli_fetch_row($result)){
                                //var_dump($row[2])."\r\n";
                               //taking data from database to views the form table
                              $file_name=$row[1];
							  
                              
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
	                        			<h3>File Name: <b><?php echo $file_name; ?> </b></h3>
	                            		
	                        		</div>
	                        		<div class="form-top-right">
	                        			
										<a href="http://146.64.213.31/WDMS/Bokang/Home.php"><i class="fa fa-backward"></i></a>
	                        		</div>
	                            </div>
								<div class="form-bottom">
									<form name="home" action="http://146.64.213.31/WDMS/Bokang/API/updateFlag" class="login-form" method="POST">
											
										
                        <table style = "border: inset 1px black; width: 100%" class="table">
                            <thead>
                              <tr style = "color: #00bfff ; width: 100%; font-weight: 200%">
                                   
                                    <th>File Path</th>
									<th>File Status</th>
                                    <th>Last Checked</th>
                                    <th>Last Modified</th>
                                    <th>Size</th>
									<th>Action</th>
                                    
                              </tr>

                            <?php


                            
                            
  
                            $conn2 = new mysqli($servername, $username, $password, $dbname);
                            $query2 ="SELECT * FROM USERFILE WHERE userfile_id = '".$userfile_id."'";
                            $result = mysqli_query($conn2,$query2);
                            while (@$row = mysqli_fetch_row($result)){
                                //var_dump($row[2])."\r\n";
                               //taking data from database to views the form table
                              $FileID=$row[0];
							  $field=$row[4];
                              $colour=$row[4];
							  $file_size = $row[7];
							  $fileSizeInKb = round($file_size, 2);
							  
                              echo "<tr tr class ='' style = 'color : 	#f5f4c4	;font-size: 14px;'>";
                              echo"<th>";
                              
                              echo $row[9];
                             echo"</th><th>";
							  
										if($field == "0")
										{
											echo '<img src="images/circle-xxl.png"" alt="" width="15" height="15"/>';
										}
										if($field == "1")
										{
											echo '<img src="images/yellow.png"" alt="" width="15" height="15"/>';
										}
										if($field == "2")
										{
											echo '<img src="images/red.png"" alt="" width="15" height="15"/>';
										}
									
                              //echo $row[4];
                              
                              echo"</th><th>";
                              echo $row[5];
                              echo"</th><th>";
							  echo $row[6];
                              echo"</th><th>";
                              echo $fileSizeInKb . " Kb";
							  
                               echo"</th><th>";

                           echo " <select  id ='bk' name='flag' style = '' >";																							
								$conn2 = new mysqli($servername, $username, $password, $dbname);
								$query2 ="SELECT replace_flag FROM USERFILE WHERE userfile_id= $userfile_id ";
								$result = mysqli_query($conn2,$query2);
								while (@$row = mysqli_fetch_row($result)){
								echo "<option value =".  $row[0] ." disabled>"  . $row[0]. "</option>";
								echo "<option value ='0'>do not replace</option>";
								echo "<option value ='1'>replace</option>";
								}

												
											
											echo "</select>";
                                                                                      
											echo "</th></tr>";}
                            $conn->close();
                            ?>

                    <script>
					
					
						
						var op = document.getElementById("bk").getElementsByTagName("option");
						for (var i = 0; i < op.length; i++) {
						// lowercase comparison for case-insensitivity
							if(op[i].value.toLowerCase()=="0")
							{
								op[i+2].disabled = true;
								


							}
							else if(op[i].value.toLowerCase()=="1")
							{
								op[i+1].disabled = true;
								
							}
						//(op[i].value.toLowerCase() == "0") 
						//? op[i].disabled = true 
						//: op[i].disabled = false ;
						}
						
					
			
					
					
					
					
					
					
					
					
					
					
					
                    // put your code here
                    /********************************************************
                       *    Utility functions for datatable column display     *
                       ********************************************************/
                       function getColour(val)
                       {
                                    // Do not draw the rectangle if indicator does not have a tlp marking/tag
                                    if(val != "red" && val != "green" && val != "white" && val != "amber") return "";
                                    var svg1 = "<svg width=\"20\" height=\"20\"><circle cx=\"10\" cy=\"10\" r=\"9\" width=\"35\" height=\"26\" style=\'fill:";
                                    var svg2 = ";\stroke:black;stroke-width:1.2;opacity:0.6\'></circle></svg>"
                                    if(val.toLowerCase() == "amber") return svg1 + "yellow" + svg2;
                                    else
                                            return svg1 + val + svg2;
                       }
                    var table = $(".table");
                            var $tr = $("tr").append(
                                    $("<td>").html(getColour("green"))
                            );
                            $tr.appendTo(".table > tbody");

                    </script>

               </thead>
             </tbody>
			
            </table> 
									
									<input type="hidden" name="userfile_id" value=" <?php echo $userfile_id; ?>">
									<button type="submit" class="btn" style = "padding: 5px 100px 2px 100px;">Update Flag</button>	
									</form>
									
										
    </body>
</html>
								
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
		
						
                      