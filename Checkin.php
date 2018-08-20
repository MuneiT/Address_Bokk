<?php

	session_start();
	require_once 'functions.php';
	$db = new DB_functions;
			$username = test_input($_POST["username"]);
			$password = test_input($_POST["password"]);
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
			$halfdate=$d->format('Y-m-d');
			
			$timein=$d->format('H:i:s');
			$timeout="00:00:00";
			
				
				
				$employee=$db->employeeLogin($username,$password);
				
			
				//check admin
					//echo "jghf".$employee-> rowCount() ;
				if($employee-> rowCount() > 0)
				{
					
						echo "jghf";
					
					foreach($employee as $value){
						
						$_SESSION['user'] = $username;
						$_SESSION['password'] = $password;
						$_SESSION['start_time'] = time();
						
						
						
						ini_set('date.timezone', 'Africa/Johannesburg');
						$time = date('H:i', time());
						
						
            
						$_SESSION['expire'] = $_SESSION['start_time'] + (1800 * 60);
						header("location: Index.html");
						echo "".$value["phone"]."~".$value["password"]."~".$value["last_name"]."~".$value["first_name"]."~".$value["first_name"]."||";
						
						
					}	
				}
				else
				{
					$message="incorrect usermame or password";
					//echo "".$message;
					header("location: login.html");
			
				}
				
				
				
				
				function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
			
			

?>