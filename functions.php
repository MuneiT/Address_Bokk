
<?php
		try{			// Connecting from a development environment.
			$conn = new pdo('mysql:host=127.0.0.1:3306;dbname=db_address_book', 'root', '');
		}
		catch(PDOException $e){
			echo"Cannot connect from a development environment".$e->getMessage();
		} 
 
  
  class DB_functions{
	  //employee login
	 public function employeeLogin($username,$password){
		try{
			global $conn;
			
			
			$sql="SELECT *  FROM  user where phone=:username and password=:password";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
			$stmt->bindParam(':password',$password); 
		    $stmt->execute();
			$rows=$stmt->rowCount();
			
           
				
				return $stmt;
			
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function selectEmployee($username){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM  employee where username=:username";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectAllFromSchedule($EmpID,$date){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM  schedule where EmpID=:EmpID AND date=:date";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectAllFromChekin($EmpID,$date){
		$timeout = "00:00:00";
		try{
			global $conn;
			
			$sql="SELECT * FROM checkin where EmpID=:EmpID AND date=:date AND timeout=:timeout";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timeout', $timeout); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectNotice($id){
		
		try{
			global $conn;
			
			$sql="SELECT content FROM  notice where noticeID='$id'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':noticeID', $id); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function getTimein($date,$empID)
	{
		
		try{
			global $conn;
			
			$sql="select timein from checkin where date='$date' and timeout='00:00:00' and empID='$empID'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':empID', $empID);
			$stmt->bindParam(':date', $date); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//schedule
	public function getSchedule($username,$password)
	{
		
		try{
			global $conn;
			
			$sql="SELECT DISTINCT employee.name,employee.surname,schedule.EmpID,schedule.date,schedule.timein,schedule.timeout,team.teamName FROM employee INNER JOIN schedule ON schedule.EmpID=employee.EmpID INNER JOIN team ON team.teamID=employee.teamID where username='$username' and password='$password'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}//Editbusinessunit
	public function Editbusinessunit($businessunitName,$businessID){
		
		try{
			global $conn;
			
			$sql="update businessunit set businessunitName=:businessunitName where businessID=:businessID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID', $managerID);
			$stmt->bindParam(':businessunitName', $businessunitName);
			$stmt->bindParam(':businessID', $businessID);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function AutoCheckOut($EmpID,$date,$timeout){
		
		try{
			global $conn;
			
			$sql="update checkin set timeout=:timeout where EmpID=:EmpID and date=:date AND timeout='00:00:00'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timeout', $timeout);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	//dismiss employee or promote
	public function dismiss($EmpID){
		
		try{
			global $conn;
			
			$sql="DELETE FROM `employee` WHERE EmpID=:EmpID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
		
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function empID($EmpID){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM  employee where EmpID=:EmpID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectAdmin($username){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM  admin where username=:username";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	//employee check in
	public function checkin($empID,$date,$timein,$timeout,$boolean){
			
			try{
			
			
			global $conn;
			$sql="INSERT INTO checkin VALUES (:empID, :date,:timein,:timeout,:boolean)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':empID', $empID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
			$stmt->bindParam(':timeout', $timeout);
			$stmt->bindParam(':boolean', $boolean);
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function overtimecheckin($empID,$date,$timein,$timeout,$boolean){
			
			try{
			
			
			global $conn;
			$sql="INSERT INTO overtime VALUES (:empID, :date,:timein,:timeout,:boolean)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':empID', $empID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
			$stmt->bindParam(':timeout', $timeout);
			$stmt->bindParam(':boolean', $boolean);
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function selectCheck($EmpID){
			
			try{
           
			global $conn;
			$sql="select * from checkin where EmpID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//admin login
	public function adminLogin($username,$password){
		try{
			global $conn;
			
			//$username = mysqli_real_escape_string($conn,$username);
			//$password = mysqli_real_escape_string($conn,$username);
			$sql="SELECT adminID,name,surname,username,password,accessID FROM  admin where username=:username and password=:password";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
			$stmt->bindParam(':password',$password); 
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
    public function assignManagersToBUnit($managerID,$businessID){
		try{
			global $conn;
			
			//$username = mysqli_real_escape_string($conn,$username);
			//$password = mysqli_real_escape_string($conn,$username);
			$sql="update businessunit set managerID =:managerID where businessID =:businessID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID', $managerID); 
			$stmt->bindParam(':businessID',$businessID); 
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
	public function managerLogin($username,$password){
		try{
			global $conn;
			
			
			$sql="SELECT * FROM  manager where username=:username and password=:password";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
			$stmt->bindParam(':password',$password); 
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//select employee working from 9 to 10
	public function nineTen()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*) as Total FROM `checkin` WHERE `timein`='09:00' and timeout='10:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//nine ten employee names
	public function nineTemEmployeenames()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='09:00' and checkin.timeout<='10:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
    
     
	public function tenElevenEmployees()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='10:00' and checkin.timeout<='11:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function elevenTwelveEmployees()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='11:00' and checkin.timeout<='12:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function TwelveThirthEmployees()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='12:00' and checkin.timeout<='13:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function ThirthForthEmployees()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='13:00' and checkin.timeout<='14:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function ForthFifthyEmployees()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='14:00' and checkin.timeout<='15:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function FifthySixthyEmployees()
	{
		
        try
		{
            
			global $conn;
			$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		    $Fulldate=$d->format('Y-m-d');
			
			$sql="SELECT employee.surname, employee.name, employee.EmpID FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID where checkin.timein>='15:00' and checkin.timeout<='16:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//employee working from 10 to 11h00
	public function tenEleven()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*) as Total1 FROM `checkin` WHERE `timein`='10:00' and timeout='11:00' and date='$Fulldate'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	//employee working from 11 to two 
	public function elevenTwelve()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
						

			$sql="SELECT Count(*)  as Total FROM `checkin` WHERE timein >= '11:00' and timeout <= '12:00' and date=:Fulldate";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		
		
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	//employee working twelve to one
	public function twelve()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*)  as Total FROM `checkin` WHERE timein >= '12:00' and timeout <= '13:00' and date=:Fulldate";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	//epmloyee working from 13 to 14:00
	public function thirteenTwo()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*)  as Total FROM `checkin` WHERE timein >= '13:00' and timeout <= '14:00' and date=:Fulldate";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//employee from 14h00 to 15:000
	public function fourteenfifthteen()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*)  as Total FROM `checkin` WHERE timein >= '14:00' and timeout <= '15:00' and date=:Fulldate";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	//employee from 15:00 to 16:00
	public function threeFour()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*)  as Total FROM `checkin` WHERE timein >= '15:00' and timeout <= '16:00' and date=:Fulldate";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	//four to 5 employee
	public function fourFive()
	{
		$d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$Fulldate=$d->format('Y-m-d');
	
        try
		{
            
			global $conn;
			
			$sql="SELECT Count(*)  as Total FROM `checkin` WHERE timein >= '16:00' and timeout <= '17:00' and date=:Fulldate";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Fulldate', $Fulldate);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function unitManager($businessID){
		try{
			global $conn;
			
			$sql="SELECT DISTINCT manager.managerID, manager.name, manager.surname, manager.payRollCode, manager.email, manager.position,businessunit.businessunitName FROM manager INNER JOIN businessunit ON manager.managerID = businessunit.managerID where businessunit.businessID =:businessID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':businessID', $businessID);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
    
    public function teamManagers($businessID,$teamId){
		try{
			global $conn;
			
			$sql="SELECT DISTINCT manager.managerID, manager.name, manager.surname, manager.payRollCode, manager.email, manager.position,team.teamName,team.teamID FROM manager INNER JOIN team ON manager.managerID = team.managerID where team.managerID=:businessID and team.teamID =:teamId";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':businessID', $businessID);
            $stmt->bindParam(':teamId', $teamId);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
    public function selectManager($username){
		try{
			global $conn;
			
			$sql="SELECT * FROM  manager where username=:username";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//getting all notices to employees
	public function notice(){
		try{
			global $conn;

			$sql="SELECT noticeID,content,date FROM  notice   ORDER BY date DESC";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':noticeID', $noticeID); 
			$stmt->bindParam(':content',$content);
			$stmt->bindParam(':date',$date); 
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	  //getting team name where an employee is assigned
	public function team($empID){
		try{
			global $conn;

			$sql="SELECT teamID,teamName,teamLeader,businessID,EmpID,managerID FROM  team where EmpID=:empID";
			$stmt = $conn->prepare($sql);
		
			$stmt->bindParam(':empID',$empID); 
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function allEmployee(){
		try{
			global $conn;

			$sql="select name,surname,phone,email,position,username,payRollCode,EmpID,teamID,username,password FROM  employee";
			$stmt = $conn->prepare($sql);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function allEmployeees(){
		try{
			global $conn;

			$sql="SELECT employee.EmpID,employee.payRollCode, employee.surname,employee.name,employee.email,employee.username,team.teamName
FROM employee,team Where employee.teamID =team.teamID;";
			$stmt = $conn->prepare($sql);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function allEmployeeClockin($username){
		try{
           
			global $conn;
			$sql="select name,surname,phone,email,position,username,payRollCode,EmpID,teamID,password FROM  employee where username=:username";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username',$username);
			
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function allManagerClockin($username){
		try{
			global $conn;

			$sql="select * FROM  manager where username=:username";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username',$username);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
		try{
           
			global $conn;
			$sql="INSERT INTO schedule values (:EmpID,:date,:timein,:timeout)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
			$stmt->bindParam(':timeout', $timeout);
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}

	}
	
    public function currentManager($id){
		try{
			global $conn;

			$sql="select * FROM  manager where managerID=:id";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id',$id);
		    $stmt->execute();
			return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
		try{
           
			global $conn;
			$sql="INSERT INTO schedule values (:EmpID,:date,:timein,:timeout)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
			$stmt->bindParam(':timeout', $timeout);
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}

	}
      
	//set checkin time and order by date time
	
	 public function teams($teamID)
	 {
		try
		{
			global $conn;
			$sql="SELECT teamName,teamLeader,businessID,EmpID from team WHERE teamID =:teamID";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	 }
	 // manager teams
	  public function managerTeam($managerID)
	 {
		try
		{
			global $conn;
			$sql="SELECT employee.name,employee.surname,employee.email,employee.position,team.teamID,team.teamName,employee.email,manager.name 
from employee inner join team on employee.teamID=team.teamID join manager on team.managerID=manager.managerID where manager.managerID='1'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID',$managerID);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	 }
	 public function SelectAllFromteams($managerID)
	 {
		try
		{
			global $conn;
			$sql="SELECT team.teamName, employee.name,employee.surname,employee.email,manager.name
FROM team
INNER JOIN employee
ON employee.teamID=team.teamID join manager where manager.managerID=team.managerID;";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID',$managerID);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	 }
	 //see  scheduled employee
	 public function schedule(){
		 try{
			 global $conn;
		$sql = "SELECT DISTINCT employee.name,employee.surname,schedule.EmpID,schedule.timein,schedule.timeout,team.teamName FROM employee INNER JOIN schedule ON schedule.EmpID=employee.EmpID INNER JOIN team ON team.teamID=employee.teamID";
		$stmt =$conn->prepare($sql);
		$stmt->execute();
		return $stmt;
		 }
	 catch(PDOException $e)
	 {
		 echo "Database Error: ". $e->getMessage();
	 }
	 }
	 //my schedule
	 public function mySchedule($username,$password){
		 try{
			 global $conn;
		$sql = "SELECT DISTINCT employee.name,employee.surname,schedule.EmpID,schedule.date,schedule.timein,schedule.timeout,team.teamName FROM employee INNER JOIN schedule ON schedule.EmpID=employee.EmpID INNER JOIN team ON team.teamID=employee.teamID where username=:username and password=:password";
		$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
			$stmt->bindParam(':password',$password); 
		    $stmt->execute();
			return $stmt;
		 }
	 catch(PDOException $e)
	 {
		 echo "Database Error: ". $e->getMessage();
	 }
	 }
  
	 //view  unscheduled
	 public function unscheduled($timein){
		 try{
			 global $conn;
			 $sql = " SELECT employee.EmpID,employee.teamID, employee.Name,employee.surname,employee.payRollCode,employee.email,employee.phone
FROM employee WHERE employee.EmpID Not IN (SELECT schedule.EmpID FROM schedule WHERE timein = '24-10-2016')";

		$stmt =$conn->prepare($sql);
		$stmt->bindParam(':timein', $timein);
		$stmt->execute();
		return $stmt;
		 }
	 catch(PDOException $e)
	 {
		 echo "Database Error: ". $e->getMessage();
	 }
	 }
	 
	 //schedule employee
	public function scheduleing($EmpID,$date,$timein,$timeout)
	{
		try{
           
			global $conn;
			$sql="INSERT INTO schedule values (:EmpID,:date,:timein,:timeout)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
			$stmt->bindParam(':timeout', $timeout);
			
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
  
      public function viewUnAsignedBusinessUnit()
	{
		try{
           
			global $conn;
			$sql="select * from businessunit where managerID =''";
			$stmt = $conn->prepare($sql);
			
            $stmt->execute();
           
				return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
    public function asignedManagerBusinessUnit($mangerID)
	{
		try{
           
			global $conn;
			$sql="update businessunit set managerID=:mangerID where managerID =''";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':mangerID', $mangerID);
            $stmt->execute();
           
				return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}  
    
	 public function addManager($surname,$name,$phone,$email,$position,$username,$password,$payRollcode,$assigned)
	{
		try{
           
			global $conn;
			$sql="INSERT INTO manager(surname,name,phone,email,position,username,password,payrollCode,Assigned) VALUES ( :surname, :name, :phone, :email, :position, :username, :password, :payRollcode,:assigned)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':surname', $surname);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':position', $position);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':payRollcode', $payRollcode);
			$stmt->bindParam(':assigned', $assigned);
            $stmt->execute();
           
				return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
		public function selectCheckin($date)
	 {
		try
		{
			global $conn;
			$sql="SELECT EmpID,status,date from checkin WHERE date=:date";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':date', $date);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	 }
	/* public function DeleteCurrent($EmpID,$status)
	{
	
		try{
			global $conn;
			$sql = "delete from checkin where EmpID =:EmpID AND status=:status";
			
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID',$EmpID);
			$stmt->bindParam(':status',$status);
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
            {
                return $stmt;
            }
            else{
                return false;
            }
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	
	}*/
	 public function deleteNotice($noticeID)
	{
	
		try{
			global $conn;
			$sql = "delete from notice where noticeID =:noticeID";
			
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':noticeID',$noticeID);
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
            {
                return $stmt;
            }
            else{
                return false;
            }
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
      
    public function deleteEmployee($EmpID)
	{
	
		try{
			global $conn;
			
			$sql = "delete from employee where EmpID =:EmpID";
			
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID',$EmpID);
            $stmt->execute();
            $rows=$stmt->rowCount();
			
            if($rows>0)
            {
                return $stmt;
            }
            else{
                return false;
            }
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	
	}
	
	public function deleteBusUnit($businessID)
	{
	
		try{
			global $conn;
			
			$sql = "DELETE FROM `businessunit` WHERE `businessunit`.`businessID` = :businessID";
			
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':businessID',$businessID);
            $stmt->execute();
            $rows=$stmt->rowCount();
			
            if($rows>0)
            {
                return $stmt;
            }
            else{
                return false;
            }
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	
	}
	
	//sign out
	public function signOut($empID,$timeout,$timein)
	{
	
        try
		{
            
			global $conn;
			
			$sql="UPDATE  checkin SET  `timeout` =:timeout WHERE  `checkin`.`EmpID` =  :empID and timein=:timein and timeout='00:00:00'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':empID', $empID);
			$stmt->bindParam(':timeout', $timeout);
			$stmt->bindParam(':timein', $timein);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
      //sign out
	public function updateTimeOutBoolean($timeout,$EmpID,$boolean,$date)
	{
	
        try
		{
            
			global $conn;
			
			$sql="UPDATE  checkin SET  timeout=:timeout , boolean=:boolean WHERE EmpID = :EmpID  and date=:date";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':timeout', $timeout);
            $stmt->bindParam(':boolean', $boolean);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
			
            $stmt->execute();
			
           
				return $stmt;
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function updateBoolean($EmpID,$boolean)
	{
	
        try
		{
            
			global $conn;
			
			$sql="UPDATE  checkin SET  boolean=:boolean WHERE  EmpID = :EmpID ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':boolean', $boolean);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//sign out overtime
	public function SignoutOverTime($empID,$timeout,$condition)
	{
	
        try
		{
            
			global $conn;
			
			$sql="UPDATE  overtime SET  timeout=:timeout , boolean=:condition WHERE  EmpID = :empID ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':empID', $empID);
			$stmt->bindParam(':timeout', $timeout);
            $stmt->bindParam(':condition', $condition);
			
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//check in limit
	public function checklimit($EmpID,$date)
	{
	
        try
		{
            
			global $conn;
			
			$sql="SELECT * FROM `checkin` WHERE `EmpID` = :EmpID AND `date` = :date";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':date', $date);
           
			
            $stmt->execute();
			
            
				return $stmt;
				
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	// add team member
	/*public function addTeam($teamID,$teamName,$teamLeader)
	{
			global $conn;
$sql = "INSERT INTO  team (`teamID` ,`teamName` ,`teamLeader` ,`businessID` ,`EmpID` ,`managerID`)VALUES ('1',  'B',  'David',  '1',  '94',  '1'
)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':NoticeID',$NoticeID);
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
            {
                return $stmt;
            }
            else{
                return false;
            }
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	
	}*/
	public function EditEmployee($teamID,$EmpID)
	{
        try
		{
			global $conn;
$sql ="UPDATE  employee SET  teamID ='$teamID'  WHERE  EmpID ='$EmpID';";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':name', $name);
			//$stmt->bindParam(':surname', $surname);
			//$stmt->bindParam(':phone', $phone);
			//$stmt->bindParam(':email', $email);
			//$stmt->bindParam(':payRollcode', $payRollCode);
				$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':teamID', $teamID);
			//$stmt->bindParam(':password', $password);
		
			//$stmt->bindParam(':position', $position);
            $stmt->execute();
			
             $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function pushNotification($content,$date,$receiver)
	{
        try
		{
            
			global $conn;
			//$sql="INSERT INTO  notice VALUES (NULL ,'wamtholake umadluphuthu ubabawakhe','2016-11-11','thilolo')";
			$sql="INSERT INTO  notice VALUES (NULL ,'$content','$date','$receiver');";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':content', $content);
			$stmt->bindParam(':dates', $date);
			$stmt->bindParam(':receiver', $receiver);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function selectAllFromBusUnit()
	{
		try
		{
			global $conn;
			$sql="SELECT * from businessunit";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function selectAllFromManager()
	{
		try
		{
			global $conn;
			$sql="SELECT * from manager";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function selectAllFromTeamID()
	{
		try
		{
			global $conn;
			$sql="SELECT * from team ";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function selectEmpForMan($managerID)
	{
		try
		{
			global $conn;
			$sql="SELECT DISTINCT employee.EmpID, employee.name, employee.surname, employee.payRollCode, employee.email, employee.position, employee.phone, employee.teamID, team.teamName, team.managerID
FROM employee
INNER JOIN team ON employee.teamID = team.teamID
INNER JOIN businessunit ON team.managerID = businessunit.managerID
where team.managerID=:managerID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID', $managerID);
			$stmt->execute();
			return $stmt;
			
		}
		 catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function transfareEmp($teamID,$EmpID)
	{
		try
		{
			global $conn;
			$sql ="UPDATE employee set teamID=:teamID where EmpID=:EmpID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID);
			$stmt->bindParam(':EmpID', $EmpID);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}

	public function viewBusTeam($teamID,$businessID){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID=:teamID AND businessunit.businessID=:businessID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID);
			$stmt->bindParam(':businessID', $businessID);			
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
    public function viewEmployees($empID){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="select * from employee where EmpID =:empID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':empID', $empID);
					
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
      
	public function viewTeamBusATeamA($managerID){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT manager.managerID as 'managerIDD', manager.name, manager.surname, manager.phone, manager.email, manager.payRollCode, team.teamName, team.managerID, team.teamID, team.businessID FROM manager INNER JOIN businessunit ON manager.managerID = businessunit.managerID INNER JOIN team ON businessunit.businessID = team.businessID WHERE manager.managerID =:managerID LIMIT 0 , 30";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID', $managerID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
      
    public function viewEmpTeamA($managerID){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone, team.teamName, team.managerID, team.teamID, team.businessID FROM employee INNER JOIN team ON employee.teamID = team.teamID INNER JOIN manager ON team.managerID = manager.managerID WHERE manager.managerID =:managerID LIMIT 0 , 30";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID', $managerID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function viewTeamBusATeamB(){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='2' AND businessunit.businessID='2'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function viewTeamBusBTeamA(){
		
		try{
			global $conn;
	
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='1' AND businessunit.businessID='1'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function viewTeamBusBTeamB(){
		
		try{
			global $conn;
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='2' AND businessunit.businessID='2'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function viewTeamBusCTeamA(){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='1' AND businessunit.businessID='3'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function viewTeamBusCTeamB(){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='2' AND businessunit.businessID='3'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function viewTeamBusDTeamA(){
		
		try{
			global $conn;
			
			//$sql="SELECT * FROM  employee where teamID=1";
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='1' AND businessunit.businessID='4'";
			$stmt = $conn->prepare($sql);
		
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	public function viewTeamBusDTeamB(){
		
		try{
			global $conn;
			
			$sql="SELECT employee.EmpID,employee.teamID,employee.name,employee.surname,employee.payRollCode,employee.email,employee.position,employee.phone,team.teamName,team.managerID 
			FROM employee inner join team on employee.teamID=team.teamID INNER JOIN businessunit 
			on team.managerID=businessunit.managerID where employee.teamID='2' AND businessunit.businessID='4'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	   	public function viewTeam2(){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM  employee where teamID=2";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
		public function insertNoticeApp($content,$date)
	{
		
		try{
			global $conn;
			$sql ="INSERT INTO notice (`noticeID`, `content`, `date`) VALUES (NULL, :content, :date);";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':content',$content);
			$stmt->bindParam(':date',$date);
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
            {
                return $stmt;
            }
            else{
                return false;
			}
		
	
	}
	catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}

	}
	public function viewNoticeApp(){
		
		try{
			global $conn;
			
			$sql="SELECT noticeID,content,date FROM  notice";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':noticeID', $noticeID); 
			$stmt->bindParam(':content', $content); 
			$stmt->bindParam(':date', $date); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function addEmployee($name,$surname,$phone,$email,$username,$password,$payRollCode,$EmpID,$teamID)
	{
        try{
           
			global $conn;

			$sql="INSERT INTO `employee` (`name`, `surname`, `phone`, `email`, `position`, `username`, `password`, `payRollCode`, `EmpID`, `teamID`) VALUES ('$name ', '$surname', '$phone', '$email', 'Employee', '$username', '$password', '$payRollCode', '$EmpID ', '$teamID');";

			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':surname', $surname);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':position', $position); 
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':payRollCode', $payRollCode);
			$stmt->bindParam(':EmpID', $EmpID);
			$stmt->bindParam(':teamID', $teamID);
		
            $stmt->execute();
            $rows=$stmt->rowCount();
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function selectForManager($username,$password){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM  manager where username=:username AND password=:password";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	 public function rememberPassword($username){
		try{
			global $conn;

			$sql="SELECT email FROM  employee where username=:username ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':username', $username); 
		 
		    $stmt->execute();
			$rows=$stmt->rowCount();
			
            if($rows>0)
			{
				return $stmt;
			}
			else{
				return false;
			}	
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function selectForBusiness(){
		
		try{
			global $conn;
			
			$sql="SELECT businessunitName,businessID FROM  businessunit";
			$stmt = $conn->prepare($sql);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectTeamForBusiness($businessID){
		
		try{
			global $conn;
			
			$sql="SELECT * FROM team where businessID=:businessID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':businessID', $businessID);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function viewUnit(){
		
		try{
			global $conn;
			
			$sql="
SELECT businessID, businessunitName, managerID
FROM businessunit";
			$stmt = $conn->prepare($sql);
		
		
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectForTeams(){
		
		try{
			global $conn;
			
			$sql="SELECT teamName FROM  team";
			$stmt = $conn->prepare($sql);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function selectUnAsgnedManagers(){
		
		try{
			global $conn;
			
			$sql="select * from manager WHERE Assigned ='No' AND position ='Unit Manager'";
			$stmt = $conn->prepare($sql);
            
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	public function lateEployees($teamID)
	{
		try{
			global $conn;
						 //EmployeeID Surname Name TeamID Email Position
			$sql="SELECT  schedule.timein as 'schedule timein',schedule.timeout as 'schedule time out',  checkin.timein as 'checkin timein',employee.teamID,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date as 'checkin date',checkin.timeout as 'checkin timeout' , employee.position from `checkin` inner join employee on
			employee.EmpID = checkin.EmpID inner join schedule on employee.EmpID = schedule.EmpID where checkin.timein > schedule.timein and employee.teamID=:teamID";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':date', $date);
			//$stmt->bindParam(':timein', $timein);
            $stmt->bindParam(':teamID', $teamID);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}

	
	public function teamLateEployees($managerID)
	{
		try{
			global $conn;
			
			$sql="SELECT team.teamName, schedule.timein as 'schedule timein',schedule.timeout as 'schedule time out',  checkin.timein as 'checkin timein',employee.teamID
			,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date as 'checkin date',checkin.timeout as 'checkin timeout' 
			, employee.position from `checkin` inner join employee on
			employee.EmpID = checkin.EmpID inner join schedule on employee.EmpID = schedule.EmpID inner join team on employee.teamID = team.teamID  where checkin.timein > 
			schedule.timein and team.managerID =:managerID";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':date', $date);
			$stmt->bindParam(':managerID', $managerID);
            
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function onTimeEployees($date,$timein,$teamID)
	{
		try{
			global $conn;
						 //EmployeeID Surname Name TeamID Email Position
			$sql="SELECT checkin.timein,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date,checkin.timeout,employee.position 
			FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID WHERE checkin.date=:date AND checkin.timein<=:timein and teamID=:teamID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
            $stmt->bindParam(':teamID', $teamID);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
      
      
    public function lateEployeesHome($unitID)
	{
		try{
			global $conn;
						 //EmployeeID Surname Name TeamID Email Position
			$sql="SELECT team.teamName, schedule.timein AS 'schedule timein', schedule.timeout AS 'schedule time out', checkin.timein AS 'checkin timein', employee.EmpID, employee.name, employee.surname, employee.teamID, employee.email, 
			checkin.date AS 'checkin date', checkin.timeout AS 'checkin timeout', employee.position
FROM `checkin` 
INNER JOIN employee ON employee.EmpID = checkin.EmpID
INNER JOIN schedule ON employee.EmpID = schedule.EmpID
INNER JOIN team ON employee.teamID = team.teamID
WHERE checkin.timein > schedule.timein
AND team.businessID = ( 
SELECT businessID
FROM businessunit
WHERE managerID =:unitID ) 
LIMIT 0 , 30";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':date', $date);
			$stmt->bindParam(':unitID', $unitID);
            
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	// selects unit managers id's for all late employess each unti
	public function adminLateEployeesHomeUnitIDs()
	{
		try{
			global $conn;
						 //EmployeeID Surname Name TeamID Email Position
			$sql="select * from manager";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':date', $date);
			//$stmt->bindParam(':unitID', $unitID);
            
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function onTimeEployeesHome($date,$timein)
	{
		try{
			global $conn;
						 //EmployeeID Surname Name TeamID Email Position
			$sql="SELECT checkin.timein,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date,checkin.timeout,employee.position FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID WHERE checkin.date=:date AND checkin.timein<=:timein ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
            
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//Employee daily attendane
	public function curentdayAttendance($managerID)
	{
		try{
			global $conn;
			 $d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$date=$d->format('Y-m-d');		
$sql="SELECT checkin.timein,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date,checkin.timeout,employee.position FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID  inner join team on team.teamID=employee.teamID inner join manager on manager.managerID=team.managerID where manager.managerID=:managerID and checkin.date='$date'";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':date', $date);
			$stmt->bindParam(':managerID', $managerID);
		
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
public function  dailyAttendance($managerID)
	{
		try{
			global $conn;
	
						
$sql="SELECT checkin.timein,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date,checkin.timeout,employee.position FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID  inner join team on team.teamID=employee.teamID inner join manager on manager.managerID=team.managerID where manager.managerID=:managerID";
			$stmt = $conn->prepare($sql);
			//$stmt->bindParam(':date', $date);
			//SELECT checkin.timein,employee.EmpID,employee.name,employee.surname,employee.teamID,employee.email,checkin.date,checkin.timeout,employee.position FROM employee INNER JOIN checkin ON checkin.EmpID=employee.EmpID  inner join team on team.teamID=employee.teamID inner join manager on manager.managerID=team.managerID where manager.managerID='1'


			$stmt->bindParam(':managerID', $managerID);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function transfareTeam($businessID, $teamID)
	{
		try
		{
			global $conn;
			$sql ="UPDATE team SET  businessID=:businessID WHERE teamID=:teamID ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':businessID', $businessID);
			$stmt->bindParam(':teamID', $teamID);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//create business unit 
	public function addBusinessUnit($managerID,$businessunitName)
	{
		try
		{
			global $conn;
			$sql ="INSERT INTO `businessunit` (`businessID`, `managerID`, `businessunitName`) VALUES (NULL, :managerID, :businessunitName); ";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':managerID', $managerID);
			$stmt->bindParam(':businessunitName', $businessunitName);
		
		
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//add new team
		public function addnewTeam($teamName,$managerID ,$businessID)
	{
		try
		{
			global $conn;
			$sql ="INSERT INTO `team` (`teamID`, `teamName`,`managerID`,`businessID`) VALUES (NULL,:teamName,:managerID,:businessID)";
			$stmt = $conn->prepare($sql);

			
			$stmt->bindParam(':teamName', $teamName);
			$stmt->bindParam(':managerID', $managerID);
			$stmt->bindParam(':businessID', $businessID);
            $stmt->execute();
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function  EmployeeAttandance()
	{
		try{
			global $conn;
						 //EmployeeID Surname Name TeamID Email Position
						 $d = new DateTime("now", new DateTimeZone("Africa/Johannesburg"));
		$date=$d->format('Y-m-d');
			$sql="SELECT DISTINCT checkin.timein, checkin.timeout, employee.EmpID, employee.name, checkin.date, employee.surname, employee.teamID, employee.email, checkin.date, employee.position
				  FROM employee JOIN checkin WHERE checkin.date <=  '$date' AND employee.EmpID = checkin.EmpID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':timein', $timein);
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	//check if team name exist
	public function teamCheck($teamID)
	{
		try
		{
			global $conn;
			$sql ="select teamID,teamName from team where teamID=:teamID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':teamID', $teamID);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//select business ID
	public function viewBusinessID()
	{
		try
		{
			global $conn;
			$sql ="select businessID from bunessunit";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//select manager id
	public function viewManagerID()
	{
		try
		{
			global $conn;
			$sql ="select managerID from manager";
			$stmt = $conn->prepare($sql);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//retrieve team manager under logged business unit manager 
	public function managerUnderBusienssUnit($managerID)
	{
		try
		{
			global $conn;
			$sql ="SELECT DISTINCT manager.managerID, manager.name, manager.surname, manager.payRollCode, manager.email, manager.position,team.teamID, manager.phone, team.teamName, team.managerID FROM manager INNER JOIN team ON manager.managerID = team.managerID INNER JOIN businessunit ON team.managerID = businessunit.managerID where team.businessID =:managerID";
			$stmt = $conn->prepare($sql);
            $stmt->bindParam(':managerID', $managerID);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//mun displaying user who didnt log out 

	public function loggedinuser($EmpID)
	{
		try
		{
			global $conn;
			$sql ="SELECT * FROM checkin where EmpID =:EmpID and boolean='false'";
			$stmt = $conn->prepare($sql);
            $stmt->bindParam(':EmpID', $EmpID);
			
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function loggedinManager($EmpID)
	{
		try
		{
			global $conn;
			$sql ="SELECT * FROM checkin where EmpID =:EmpID and boolean='false'";
			$stmt = $conn->prepare($sql);
            $stmt->bindParam(':EmpID', $EmpID);
			
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//select employee for team manager
	public function teamManagerEmployee()
	{
		try
		{
			global $conn;
			$sql ="SELECT * FROM `manager` ";
			$stmt = $conn->prepare($sql);
           
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	public function attendance($managerID)
	{
		try
		{
			global $conn;
			$sql ="SELECT DISTINCT employee.EmpID,employee.surname,employee.name,checkin.date,checkin.timein,checkin.timeout FROM employee INNER JOIN checkin ON employee.EmpID= checkin.EmpID INNER JOIN team ON employee.teamID = team.teamID INNER JOIN manager ON team.managerID = manager.managerID where team.managerID =:managerID AND manager.position='Team Manager' ORDER BY date asc";
			$stmt = $conn->prepare($sql);
			  $stmt->bindParam(':managerID', $managerID);
            $stmt->execute();
			
            $rows=$stmt->rowCount();
			
	
            if($rows>0){
				return $stmt;
			}
			else{
				return false;
			}	
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//insert one value when checkin munei
	 public function checkinOnce($date,$EmpID){
		try{
			global $conn;

			$sql="SELECT * FROM `checkin` WHERE `EmpID` = '$EmpID' AND `date` = '2016-11-10' ORDER BY `date` ASC";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID); 
			$stmt->bindParam(':date', $date); 
		    $stmt->execute();
		
			return $stmt;
			
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	//update logout once user checkout inresponce to his schedule
	 public function verifyCheckout($date,$EmpID,$timeout ){
		try{
			global $conn;

			$sql="SELECT * FROM `schedule` WHERE `EmpID` = '$EmpID' AND `date` = '$date' AND `timeout` >= '$timeout' ORDER BY `date` ASC";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':EmpID', $EmpID); 
			$stmt->bindParam(':date', $date); 
			$stmt->bindParam(':timeout', $timeout);
		    $stmt->execute();
		
			return $stmt;
			
			
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
	}
	
	public function compareSchedule(){
		
		try{
			global $conn;
			
			$sql="SELECT * from schedule";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':noticeID', $id); 
		    $stmt->execute();
			return $stmt;
		}
		catch(PDOException $e){
			echo "Database Error: ". $e->getMessage();
		}
		
	}
	
	
}
	

?>