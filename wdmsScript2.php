<?php
///////**********************Variables*******************************/////////////
$dir = getcwd();
$the_input = "ivdhfe:w:s:p:";
$files1 = array();
global $user_email;
global $ip_address;
global $web_address;
global $path;

$user='glenn';
$password='1234';
$dbname = 'academycity';

$dbCon = true; 
$date1 = date('Y-m-d H:i:s');
$file_status1 = '0';
$file_status2 = '1';
$file_status3 = '2';
$file_value = 0;
$id_file = '';
$var = getopt($the_input);
///////**********************Variables*******************************/////////////

///////**********************Execute Get Input Function*******************************/////////////
getInputs($var);
///////**********************Execute Perform Action Function*******************************/////////////

///////**********************Execute dbConnection Function*******************************/////////////
$DBConnection = dbConnection();
///////**********************Execute dbConnection Function*******************************/////////////

///////**********************Get root directory content*******************************/////////////
$directory = $path;

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

while($it->valid())
{
    $it->next();
    $files1 = $it;
}
///////**********************Get root directory content*******************************/////////////

///////**********************Execute Perform Action Function*******************************/////////////
performAction($var,$DBConnection);
///////**********************Execute Perform Action Function*******************************/////////////

///////**********************Check data in database function*******************************/////////////
function checkBeforeUpdate($file_name, $DBConnection)
{
	mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	$sql = "SELECT * FROM USERFILE WHERE file_name ='".basename($file_name)."' AND user_email='".$GLOBALS['user_email']."' AND ip_address='".$GLOBALS['web_address']."'";
	$result = mysqli_query($DBConnection,$sql) or die("Error in $sql:" . mysqli_error($DBConnection));	

	while($row = mysqli_fetch_object($result)) {
	      $GLOBALS['id_file'] = $row->userfile_id;
	}
	return $GLOBALS['id_file']; 
}
///////**********************Check data in database function*******************************/////////////

///////**********************Verify function*******************************/////////////
function checkForIntruderFiles($DBConnection)
{
	echo "\033[0mChecking for Intruder Files.\r\n";
	foreach($GLOBALS['files1'] as $file_name)
	{ 
		if(basename($file_name) != '.' && basename($file_name) != '..')
		{
			mysqli_select_db($DBConnection,$GLOBALS['dbname']);
			$sql = "SELECT * FROM USERFILE WHERE user_email='".$GLOBALS['user_email']."' AND ip_address='".$GLOBALS['web_address']."' AND file_path='".$file_name."'";
			$result = mysqli_query($DBConnection,$sql) or die("Error in $sql:" . mysqli_error($DBConnection));	
			
			//echo "File Tested: ".basename($file_name)."\r\n";
			if( mysqli_num_rows($result)!=0)
			{
				//echo ("file must be here: ".basename($file_name)."\r\n");
			}
			else
			{
				echo ("\033[0mINTRUDER FILE: "."\033[34m".basename($file_name)."\r\n");
				unlink($file_name);
			}
			
		}  
	}
}
///////**********************Verify function*******************************/////////////

///////**********************Initialize function*******************************/////////////
function initialize($DBConnection)
{
	echo "Initializing Webserver\r\n";
	foreach($GLOBALS['files1'] as $file_name)
	{ 
		if(basename($file_name) != '.' && basename($file_name) != '..')
		{
		      sendToDB($file_name,md5_file(realpath($file_name)),$GLOBALS['date1'],$GLOBALS['date1'],$GLOBALS['file_status1'],$DBConnection);
		}
	}
	echo "Initialized Webserver: ".$GLOBALS['web_address']."\r\n";
}
///////**********************Initialize function*******************************/////////////

///////**********************Database connection function*******************************/////////////
function dbConnection()
{
	$con=mysqli_connect($GLOBALS['ip_address'],$GLOBALS['user'],$GLOBALS['password'], $GLOBALS['dbname']);
    
	if(!$con)
	{
		exit("Cannot connect to the Database");
	}
	else
	{
		return $con;
	}
  
}
///////**********************Database connection function*******************************/////////////

///////**********************Execute database function*******************************/////////////
function executeStatement($sqlstat,$sqlcon)
{
	if(!mysqli_query($sqlcon,$sqlstat))
	{
	    die('Could not enter data: ' . mysqli_error($sqlcon))."\r\n";
	}
	else
	{
	    //echo "Data entered successfully\n";
	}

}
///////**********************Execute database function*******************************/////////////

///////**********************Send to database function*******************************/////////////
function sendToDB($file_name,$hash,$last_date,$replaced_date,$file_status,$DBConnection)
{   
	$new_size = filesize(realpath($file_name))/1024; 
	$source_file = addslashes(file_get_contents(realpath($file_name)));	
	$file_type = filetype(realpath($file_name));
   
	global $usernum;

	$sql = "SELECT * FROM USERS WHERE user_email ='".$GLOBALS['user_email']."'";
	mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	$result = mysqli_query($DBConnection,$sql) or die("Error in $sql:" . mysqli_error($DBConnection));
	
	while($row = mysqli_fetch_object($result))
	{
		$GLOBALS['usernum'] = $row->user_id;
	} 
    
	$mysql='INSERT INTO USERFILE'.'(file_name,user_id,user_email,userFileStatus,userLastChecked,userLastReplaced,file_path,file_size,hash,file_content,ip_address,replace_flag)'.'VALUES ("'.basename($file_name).'","'.$GLOBALS['usernum'].'","'.$GLOBALS['user_email'].'","'.$file_status.'","'.$GLOBALS['date1'].'","'.$GLOBALS['date1'].'","'.realpath($file_name).'","'.$new_size.'","'.$hash.'","'.$source_file.'","'.$GLOBALS['web_address'].'","'.$GLOBALS['file_value'].'")';
	mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	executeStatement($mysql, $DBConnection);
}
///////**********************Send to database function*******************************/////////////

///////**********************Get hashes*******************************/////////////
function getFilehashes($id_name,$id_file,$id_content,$id_hash,$hash,$DBConnection)
{
		 
		if(basename($id_file) == $id_name && $hash != $id_hash)
		{
			echo "\033[0mChanged File: "."\033[35m".basename($id_file)."\r\n";
			recopy_file($id_file,$id_content,$GLOBALS['date1'],$DBConnection);
			setStatus($id_file,$GLOBALS['file_status2'],$DBConnection);
		}
		else
		{
			echo "\033[0mFile did not change: "."\033[32m".basename($id_file)."\r\n";
            setStatus($id_file,$GLOBALS['file_status1'],$DBConnection);
		}

}
///////**********************Get hashes*******************************/////////////

///////**********************Update replace file function*******************************/////////////
function replaceFileStatus($id_name,$id_file,$id_content,$id_hash,$hash,$DBConnection)
{
		 
		if(basename($id_file) == $id_name && $hash != $id_hash)
		{
			echo "\033[0mChanged File: "."\033[35m".basename($id_file)."\r\n";
			setStatus($id_file,$GLOBALS['file_status2'],$DBConnection);
		}
		else
		{
			echo "\033[0mFile did not change: "."\033[32m".basename($id_file)."\r\n";
            setStatus($id_file,$GLOBALS['file_status1'],$DBConnection);
		}

}
///////**********************Update replace file function*******************************/////////////

///////**********************Force function*******************************/////////////
function forceReplace($DBConnection)
{
    mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	$sql = "SELECT * FROM USERFILE WHERE user_email='".$GLOBALS['user_email']."' AND ip_address='".$GLOBALS['web_address']."'";
	$result = mysqli_query($DBConnection,$sql) or die("Error in $sql:" . mysqli_error($DBConnection));
    
    while($row = mysqli_fetch_object($result))
	{
		$id_name = $row->file_name;
		$id_file = $row->file_path;
		$id_content = $row->file_content;
		$id_hash = $row->hash;
		
		$fileDir = pathinfo($id_file,PATHINFO_DIRNAME);
		if(!file_exists($id_file))
		{
			createPath($fileDir);
			echo "\033[0mFile has been removed: "."\033[31m".$id_name."\r\n";
			remakeScript($id_file,$id_content);
			setStatus($id_file,$GLOBALS['file_status3'],$DBConnection);
		}
		else
		{
			getFilehashes($id_name,$id_file,$id_content,$id_hash,md5_file($id_file),$DBConnection);
		}
	}
	
}
///////**********************Force function*******************************/////////////


///////**********************Recopy function*******************************/////////////
function recopy_file($the_file1,$the_content,$the_date,$DBConnection)
{
	file_put_contents(realpath($the_file1),$the_content);
	updateDB($the_file1,$GLOBALS['date1'],$DBConnection);
}
///////**********************Recopy function*******************************/////////////

///////**********************Update database function*******************************/////////////
function updateDB($file_name,$replaced_date,$DBConnection)
{
  //$file_id = checkBeforeUpdate($file_name,$DBConnection);

  $mysql = "UPDATE USERFILE SET userLastReplaced ='".$replaced_date."' WHERE file_path ='".$file_name."'AND file_name='".basename($file_name)."'AND user_email='".$GLOBALS['user_email']."'AND ip_address='".$GLOBALS['web_address']."'";
  mysqli_select_db($DBConnection,$GLOBALS['dbname']);
  executeStatement($mysql,$DBConnection);
}
///////**********************Update database function*******************************/////////////

///////**********************Delete function*******************************/////////////
function deleteContent($DBConnection)
{
	echo "Clearing up the Database\r\n";

	$mysql = "DELETE FROM USERFILE WHERE user_email='".$GLOBALS['user_email']."'AND ip_address='".$GLOBALS['web_address']."'";
	mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	executeStatement($mysql,$DBConnection);
}
///////**********************Delete database function*******************************/////////////

///////**********************Recreate file function*******************************/////////////
function remakeScript($file_name,$the_content)
{
	$fp = fopen($file_name,"w");
	fwrite($fp,$the_content);
	fclose($fp);
}
///////**********************Recreate file function*******************************/////////////


///////**********************Reset file status*******************************/////////////
function setStatus($file_name,$file_status,$DBConnection)
{
	$mysql = "UPDATE USERFILE SET userFileStatus ='".$file_status."' WHERE user_email='".$GLOBALS['user_email']."'AND ip_address='".$GLOBALS['web_address']."' AND file_path='".$file_name."'";
	mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	executeStatement($mysql,$DBConnection);
}
///////**********************Reset file status*******************************/////////////


///////**********************Check if file still exists function*******************************/////////////
function existance($DBConnection)
{
	mysqli_select_db($DBConnection,$GLOBALS['dbname']);
	$sql = "SELECT * FROM USERFILE WHERE user_email='".$GLOBALS['user_email']."' AND ip_address='".$GLOBALS['web_address']."'";
	$result = mysqli_query($DBConnection,$sql) or die("Error in $sql:" . mysqli_error($DBConnection));	

	while($row = mysqli_fetch_object($result))
	{
		$id_name = $row->file_name;
		$id_file = $row->file_path;
		$id_content = $row->file_content;
		$id_hash = $row->hash;
		$id_replace = $row->replace_flag;
		
        if($id_replace == 1)
        {
            $fileDir = pathinfo($id_file,PATHINFO_DIRNAME);
            if(!file_exists($id_file))
            {
                createPath($fileDir);
                echo "\033[0mFile has been removed: "."\033[31m".$id_name."\r\n";
                remakeScript($id_file,$id_content);
                setStatus($id_file,$GLOBALS['file_status3'],$DBConnection);
            }
            else
            {
                getFilehashes($id_name,$id_file,$id_content,$id_hash,md5_file($id_file),$DBConnection);
            }
        }
        else
        {
            replaceFileStatus($id_name,$id_file,$id_content,$id_hash,md5_file($id_file),$DBConnection);
        }
	}
}
///////**********************Check if file still exists function*******************************/////////////

///////**********************Create Path function*******************************/////////////
function createPath($path) {
    if (is_dir($path)) return true;
    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    $return = createPath($prev_path);
    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}
///////**********************Create Path function*******************************/////////////

///////**********************Get Input function*******************************/////////////
function getInputs($var)
{
	
	if(isset($var["h"]) || $var==NULL)
	{
		//Help option 
		exit(
			"-i -e <Email Address> -w <Webserver Domain> -s <Server Address> -p <Path> \r\n".
			"-v -e <Email Address> -w <Webserver Domain> -s <Server Address> -p <Path> \r\n".
			"-d -e <Email Address> -w <Webserver Domain> -s <Server Address> -p <Path> \r\n".
			"-h Help \r\n"
		);
	}
	if(isset($var["e"]))
	{
		if($var["e"])
		{
		  //Getting email
		  $GLOBALS['user_email'] = strtolower($var["e"]);
			echo "Set user e-mail to: ".$GLOBALS['user_email']."\r\n";
		}
	}
	if(isset($var["s"]))
	{
		if($var["s"])
		{
		   //Getting Server IP
		  $GLOBALS['ip_address'] = $var["s"];
			echo "Set IP Address to: ".$GLOBALS['ip_address']."\r\n";
		}
	}
	if(isset($var["p"]))
	{
		if($var["p"])
		{
		   //Getting Server IP
		  $GLOBALS['path'] = $var["p"];
			echo "Set Web Path to: ".$GLOBALS['path']."\r\n";
		}
	}
	if(isset($var["w"]))
	{
		if($var["w"])
		{
			//Getting Web Address
			$GLOBALS['web_address'] = $var["w"];
			echo "Set web address to: ".$GLOBALS['web_address']."\r\n";
		}
	}
	if($GLOBALS['web_address'] == NULL || $GLOBALS['path'] == NULL || $GLOBALS['ip_address'] == NULL || $GLOBALS['user_email'] == NULL)
	{
		exit("Not all variables defined\r\n");
	}
}
///////**********************Get Input function*******************************/////////////

///////**********************Perform Action function*******************************/////////////
function performAction($var,$DBConnection)
{
	if(isset($var["i"]))
	{
		//Delete content in db first
		deleteContent($DBConnection);
		initialize($DBConnection);
	}
	else if(isset($var["v"]))
	{
		//Verify if file still exists else recreate file
		existance($DBConnection);   
		//Check intruder
		checkForIntruderFiles($DBConnection);
		
	}
	else if(isset($var["d"]))
	{
		deleteContent($DBConnection);
	} 
    else if(isset($var["f"]))
    {
        //Force Replace
        forceReplace($DBConnection);
        //Verify option
		checkForIntruderFiles($DBConnection);
        //Verify if file still exists else recreate file
		existance($DBConnection); 
    }
}
///////**********************Perform Action function*******************************/////////////

mysqli_close($DBConnection);
exit("\033[0mScript Performed Succesfully!\r\n");

?>
