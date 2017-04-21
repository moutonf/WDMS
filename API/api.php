<?php

	require_once("Rest.inc.php");
        

	class API extends REST {

		public $data = "";
		public $url = "/WDMT/Home.php";
		public $url2 = "/WDMT/Unsuccessful.php";              
		public $url4 = "/WDMT/index.php";
		public $url5 = "/WDMT/Register.php";
		public $url3 = "/WDMT/intranet.php";
		public $url6 = "/WDMT/admin.php";
		public $url7 = "/WDMT/moreinfo.php? " . "UserFileID=". "h";
		public $url8 = "/WDMT/Test2.php";
	
 

		const DB_SERVER = "127.0.0.1";
		const DB_USER = "root";
		const DB_PASSWORD = "";
		const DB = "academycity";

		private $db = NULL;
		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
		}


                public function getcwd ()
                {

                }

		/*
		 *  Database connection
		*/
		private function dbConnect(){
			$this->db = @mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD);
			if($this->db)
			{
			   mysqli_select_db(DB,$this->db);
			}   
		}

		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */

		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
			{
				$this->$func();
			}
			else
			{
				$this->response('',404);
				// If the method not exist with in this class, response would be "Page not found".
			}
		}
		public function Redirect() {
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url . '";</script>');
					}else{
						  header('Location: ' . $this->url);
					 die();
					}
		}
		
		
		public function Redirect2() {
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url3 . '";</script>');
					}else{
						  header('Location: ' . $this->url3);
					 die();
					}
		}
		
			public function Redirect3() {
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url7 . '";</script>');
					}else{
						  header('Location: ' . $this->url7);
					 die();
					}
		}
		
		

		public function Unsucessful() {
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url2 . '";</script>');
					}else{
						  header('Location: ' . $this->url2);
					 die();
					}
		}
		
		
		public function Unsucessful2() {
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url6 . '";</script>');
					}else{
						  header('Location: ' . $this->url6);
					 die();
					}
		}


		public function GoBack (){
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url4 . '";</script>');
					}else{
						  header('Location: ' . $this->url4);
					 die();
					}
		}
		
		public function GoBack2 (){
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url6 . '";</script>');
					}else{
						  header('Location: ' . $this->url6);
					 die();
					}
		}

		 public function GoBackRegister (){
			if (headers_sent()){
				die('<script type="text/javascript">window.location.href="' . $this->url5 . '";</script>');
					}else{
						  header('Location: ' . $this->url5);
					 die();
					}                          
		}

		public function PasswordError ()
		{
			if (headers_sent())
			{
				die('<script type="text/javascript">window.location.href="' . $this->url6 . '";</script>');
			}
			else
			{
	     		header('Location: ' . $this->url6);
				die();
			}
		}
		
		public function errorPage()
		{
			session_start();
			$_SESSION["error"] = "Invalid Email or Password";
			session_write_close();
			header("Location: /WDMT/index.php");
		}
		
		public function errorRegisterPage()
		{
			session_start();
			$_SESSION["the_error"] = "Invalid Email Address";
			session_write_close();
			header("Location: /WDMT/Register.php");
		}
		
		public function errorDetails()
		{
			session_start();
			$_SESSION["the_error"] = "Invalid User Details Were Entered";
			session_write_close();
			header("Location: /WDMT/Register.php");
		}
		
		public function errorMatch()
		{
			session_start();
			$_SESSION["the_error1"] = "Passwords Do Not Match";
			session_write_close();
			header("Location: /WDMT/Register.php");
		}
		
		public function errorRequirements()
		{
			session_start();
			$_SESSION["require_pass"] = "Passwords Does Not Meet Requirements";
			session_write_close();
			header("Location: /WDMT/Register.php");
		}
		

		public function Logout ()
		{
		   session_start();
			//ending the session for the user
			session_destroy();
			//then redirecting a user to the home page
		   $this->GoBack();
		}
		
		public function Logout2 ()
		{
		   session_start();
			//ending the session for the user
			session_destroy();
			//then redirecting a user to the home page
		   $this->GoBack2();
		}

	

		/*
		 *	Simple login API
		 *  Login must be POST method
		 *  email : <USER EMAIL>
		 *  pwd : <USER PASSWORD>
		 */

		
		
		private function login2()
		{
			
			$email = $this->_request['admin_email'];
			$password = $this->_request['admin_password'];
		
			if($email == "admin@csir.co.za" && $password == "Admin@1234")
			{

			    session_start();
				$_SESSION['admin'] = 'admin';
				echo json_encode($_SESSION);
			
				$this->Redirect2();
			
			}
			else
			{
				$this->response('Wrong credentials',203);
			}
				
		}
		
		
		private function login()
		{
		    $the_connection = mysqli_connect("127.0.0.1","root","","academycity");
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST")
			{
				$this->response('',406);
			}

			//Validate password
            $email = $this->_request['user_email'];
			$password = $this->_request['user_password'];
			$valid_password = false;
			$valid_email = false;
			
			if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,16}$/', $password))
			{
				$passwordhash = hash('sha256', $password); //hash password
				$valid_password = true;
			}
			else
			{
				$valid_password = false;
			}
			
			if(!filter_var($email, FILTER_SANITIZE_EMAIL)== false && !filter_var($email, FILTER_VALIDATE_EMAIL) == false)
			{
				$valid_email = true;	
			}
			else
			{
				$valid_email = false;
			}
			
			// Input validations
			if(!empty($email) and !empty($password))
			{
				if($valid_email == true && $valid_password == true)
				{	
					$sql = mysqli_query($the_connection,"SELECT user_id, user_fullname, user_email FROM users WHERE user_email = '$email' AND user_password = '".md5($passwordhash)."' LIMIT 1");
					if(mysqli_num_rows($sql) > 0)
					{
						 if(mysqli_num_rows($sql) > 0)
						{
							if($email == "admin@csir.co.za" and $password == "Admin@1234" )
							{
								  session_start();
								  $_SESSION["admin"] = 'admin';
								  session_write_close();
								  header("Location: /WDMT/intranet.php");
 
							}
							else
							{
								  session_start();
								  $_SESSION["csir"] = $email;
								  session_write_close();
								  header("Location: /WDMT/Home.php");
							}	  
						}
					}
				}
				else
				{
					$this->errorPage();
				}
			}
			else
			{
				$this->errorPage();
			}
			mysqli_close($the_connection);
		} 
		
		
		private function insertUser()
		{

			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
			   $valid_password = false;
			   $valid_password1 = false;
			   $valid_email = false;
			   $the_connection = mysqli_connect("127.0.0.1","root","","academycity");
			   $user_fullname = isset($_POST['user_fullname']) ? mysqli_real_escape_string($the_connection,$_POST['user_fullname']) : "";
			   $user_email = isset($_POST['user_email']) ? mysqli_real_escape_string($the_connection,$_POST['user_email']) : "";
			   $user_password = isset($_POST['user_password']) ? mysqli_real_escape_string($the_connection,$_POST['user_password']) : "";
			   $user_passwordconf = isset($_POST['user_passwordconf']) ? mysqli_real_escape_string($the_connection,$_POST['user_passwordconf']) : ""; 
		
			 			   
			   if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,16}$/', $user_password) && preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,16}$/', $user_passwordconf))
			   {
					$valid_password = true;
			   }
			   else
			   {
					$valid_password = false;
			   }   
			   
			   if(!filter_var($user_email, FILTER_SANITIZE_EMAIL)== false && !filter_var($user_email, FILTER_VALIDATE_EMAIL) == false)
			   {
					$valid_email = true;	
			   }
			   else
			   {
					$valid_email = false;
			   }
				
			   if ($user_password == $user_passwordconf )
			   {  
					$valid_password1 = true;
			   }
			   else
			   {
					$valid_password1 = false;
			   }
		
				//If all data entered is incorrect
				if(!$valid_password == true && !$valid_email == true &&  !$valid_password1 == true)
				{
					$this->errorDetails();
				}
				else
				{
					if($valid_email == true)
					{				
						if($valid_password == true)
						{
							if($valid_password1 == true)
							{
								$passwordhash = hash('sha256', $password); //hash password
								$sql = "INSERT INTO users (user_fullname, user_email, user_password) VALUES ('$user_fullname', '$user_email', '".md5($user_passwordhash)."')";
								if (!mysqli_query($the_connection, $sql)) 
								{
									echo "Error: " . $sql . "<br>" . mysqli_error($the_connection);
								}
								else
								{
									$this->GoBack();
								}
							}
							else
							{
								$this->errorMatch();
							}
						}
						else
						{
						$this->errorRequirementss();
						}
					}
					else
					{
					$this->errorRegisterPage();
					}				
				}
			   
			   
			   /*
			   //Validate email
			   if(filter_var($user_email, FILTER_VALIDATE_EMAIL))
			   {

				   if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,16}$/', $user_password) && preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,16}$/', $user_passwordconf))
				   {
						if ($user_password == $user_passwordconf )
						{   //check if passwords match

							$user_passwordhash = hash('sha256', $user_password); //hash password

							//if(0 == $status)
							//{                                      
								//Insert data into data base
								$sql = "INSERT INTO users (user_fullname, user_email, user_password) VALUES ('$user_fullname', '$user_email', '".md5($user_passwordhash)."')";
								
								// Check connection
								if (!$the_connection) {
									die("Connection failed: " . mysqli_connect_error());
								}

							
								if (!mysqli_query($the_connection, $sql)) 
								{
									echo "Error: " . $sql . "<br>" . mysqli_error($the_connection);
								}


								$query2 ="SELECT user_id FROM USERS WHERE user_email = '". $user_email ."'";
								$result = mysqli_query($the_connection,$query2);
								while (@$row = mysqli_fetch_row($result))
								{
										//var_dump($row[2])."\r\n";
								   //taking data from database to views the form table
								  $user_id=$row[0];

								  session_start();
								  $_SESSION["csir2"] = $user_email;
								  
								  //returnEmail($user_email);
								}
								
								
								$query3 ="SELECT userfile_id FROM USERFILE";
								$result3 = mysqli_query($the_connection,$query3);
								while (@$row = mysqli_fetch_row($result3)){
										//var_dump($row[2])."\r\n";
								   //taking data from database to views the form table
								  $userfile_id=$row[0];
								}

								$this->GoBack();

								//$qur = $conn->query($sql);
						   // }

						}
						else

						//echo "Passwords don't match";
						$this->response('Passwords do not match',203);
				   }

				   else
				   {
					   //echo "Password does't meet requirements";
					   $this->response("Password does't meet requirements",203);
				   }
			   }
			   else
			   {
				   //echo "Invalid email";
				   $this->response('Invalid email',203);
			   }
			}*/

			mysqli_close($the_connection);

			/* Output header */
			header('Content-type: application/json');
			echo json_encode($json);
			}
		}
		
		private function users()
		{
			$the_connection = mysqli_connect("127.0.0.1","root","","academycity");
			// Cross validation if the request method is GET else it will return "Not Acceptable" status
			if($this->get_request_method() != "GET")
			{
				$this->response('',406);
			}

			$sql = mysqli_query($the_connection,"SELECT user_id, user_fullname, user_email FROM users WHERE user_status = 1");
			if(mysqli_num_rows($sql) > 0)
			{
				$result = array();
				while($rlt = mysqli_fetch_array($sql,mysqli_ASSOC))
				{
					$result[] = $rlt;
				}
			// If success everythig is good send header as "OK" and return list of users in JSON format
			//$this->response($this->json($result), 200);
					$this->DisplayUsers();
			}
			$this->response('',204);	// If no records "No Content" status
			
			mysqli_close($the_connection);
		}

		private function user()
		{
		    $the_connection = mysqli_connect("127.0.0.1","root","","academycity");
			$id = (int)$this->_request['user_id'];
			// Cross validation if the request method is GET else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST")
			{
				$this->response('',406);
			}
			$sql = mysqli_query($the_connection,"SELECT user_id, user_fullname, user_email FROM users WHERE user_id = $id");
			if(mysqli_num_rows($sql) > 0)
			{
				$result = array();
				while($rlt = mysqli_fetch_array($sql,mysqli_ASSOC))
				{
					$result[] = $rlt;
				}
				// If success everythig is good send header as "OK" and return list of users in JSON format
				$this->response($this->json($result), 200);
			}
			$this->response('',204);	// If no records "No Content" status
			
			mysqli_close($the_connection);
		}

		private function deleteUser()
		{
		    $the_connection = mysqli_connect("127.0.0.1","root","","academycity");
			// Cross validation if the request method is DELETE else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST")
			{
				$this->response('',406);
			}
			$id = (int)$this->_request['user_id'];
			if($id > 0)
			{
				mysqli_query($the_connection,"DELETE FROM users WHERE user_id = $id");
				$success = array('status' => "Success", "msg" => "Successfully one record deleted.");
				$this->response($this->json($success),200);
			}
			else
			{
				$this->response('',204);	// If no records "No Content" status
			}
			
			mysqli_close($the_connection);
		}
		
		
		private function updateFlag()
		{
		
		    $the_connection = mysqli_connect("127.0.0.1","root","","academycity");
			
			if($this->get_request_method() != "POST")
			{
				$this->response('',406);
			}
			//Validate password
            $flag = $this->_request['flag'];
			$userfile_id = $this->_request['userfile_id'];
	
			$selectOption = $_POST['flag'];
			$ourfile = $_POST['userfile_id'];
			$sql = mysqli_query($the_connection,"UPDATE userfile SET replace_flag = '". $selectOption ."' WHERE userfile_id = '". $ourfile ."'");
			echo $ourfile. '<br/>'; 
			echo $selectOption;
			//$this->Redirect3();
				
			mysqli_close($the_connection);
		}
		
		
		private function updateUser()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST"){
			    $the_connection = mysqli_connect("127.0.0.1","root","","academycity");
				$user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($the_connection,$_POST['user_id']) : "";
				$user_fullname = isset($_POST['user_fullname']) ? mysqli_real_escape_string($the_connection,$_POST['user_fullname']) : "";
				$user_email = isset($_POST['user_email']) ? mysqli_real_escape_string($the_connection,$_POST['user_email']) : "";
				$user_password = isset($_POST['user_password']) ? mysqli_real_escape_string($the_connection,$_POST['user_password']) : "";
				$user_status = isset($_POST['user_status']) ? mysqli_real_escape_string($the_connection,$_POST['user_status']) : "";
				$user_passwordhash = hash('sha256', $user_password);


				// Insert data into data base
				mysqli_query($the_connection,"UPDATE users SET user_fullname='$user_fullname', user_email='$user_email', user_password='".md5($user_passwordhash)."',user_status='$user_status' WHERE user_id='$user_id'");
				$result = mysqli_fetch_array($mysqli_query,mysqli_ASSOC);

						// If success everythig is good send header as "OK" and user details
						$this->response($this->json($result), 200);

				$qur = $the_connection->query($mysqli_query);
				if($qur){
					$json = array("status" => 1, "msg" => "Done User added!");
				}else{
					$json = array("status" => 0, "msg" => "Error adding user!");
					}
				}else{
					$json = array("status" => 0, "msg" => "Request method not accepted");
					}

				$mysqli_close($the_connection);

			/* Output header */
			 header('Content-type: application/json');
			 echo json_encode($json);
		}
			/*
			 *	Encode array into JSON
			*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}

	// Initiiate Library

	$api = new API;
	$api->processApi();
?>