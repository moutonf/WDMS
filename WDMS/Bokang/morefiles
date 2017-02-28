<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="MyCSS.css" rel="stylesheet">
        <title>More Files</title>
    </head>
    <body>
	<?php
	session_start();   //starting the session
							if(!$_SESSION['csir']){
							header ("Location: index.php");
							
							//get user_id from the created session_cache_expire
							}    
							$logged_in_person=$_SESSION['csir'];

							
							
							
                            $FileID= "";
                            $servername = "127.0.0.1";
                            $username = "root";
                            $password = "";
                            $dbname = "wdmtf";
                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                            }
							?>
        <div class ="container">
            <div class ="main-center" style ="padding: 10px 50px;">
               <h2>Add a website</h2>
            </div>
            
            <div class ="main-login" style = "background:#009edf; margin: 0 auto; max-width: 900px; padding: 10px 40x;color: #fff; text-shadow: none;  margin-top: 100px; ">

                <form name="upload" action="upload.php" method="POST" enctype="multipart/form-data">
	
	<input type="file" name="file" /></br>
	<button type="submit" name="btn-upload">upload</button>
	<br>
	<label>Website URL</label>
	<input type="text" name="ref_num">
	<br>
	<label>Description</label>
	<input type="text" name="details">                  


          <div class ="form-group">
				
                <input type="submit" value="Add Website" name="addweb" id="addweb" class="btn btn-primary btn-lg btn-block login-button" />
				
          </div>
       </form>
	   <?php
	if(isset($_GET['success']))
	{
		?>
        <label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
        <label>Problem While File Uploading !</label>
        <?php
	}
	else
	{
		?>
        <label>Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
        <?php
	}
	?>
	<br>
	   <?php echo $GLOBALS['logged_in_person'];?>
	   <br>
	   
	   <a href="http://127.0.0.1/projects/web/scripts/Update.php">GGGGGGG</a>
	   

      </div>
    </div>
          
    </body>
</html>