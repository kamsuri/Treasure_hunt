<?php
session_start();
class Users {
	public $table_name = 'users';
	
	function __construct(){
		//database configuration
		$dbServer = 'localhost'; //Define database server host
		$dbUsername = 'csinseew_tech15'; //Define database username
		$dbPassword = 'rSyP1^7&~(c{rhHX}p'; //Define database password
		$dbName = 'csinseew_enigmata'; //Define database name
		
		//connect databse
		$con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
		if(mysqli_connect_errno()){
			die("Failed to connect with MySQL: ".mysqli_connect_error());
		}else{
			$this->connect = $con;
		}
	}


	
	function checkUser($oauth_provider,$oauth_uid,$fname,$lname,$email,$gender){
		    $_SESSION['first_name']=$fname;
			$_SESSION['last_name']=$lname;
			$_SESSION['oauth_provider']=$oauth_provider;
			$_SESSION['oauth_uid']=$oauth_uid;
			$_SESSION['gender']=$gender;
			$_SESSION['emailid']=$email;
			$_SESSION['loggedin']=true;
		$prev_query = mysqli_query($this->connect,"SELECT * FROM `$this->table_name` WHERE `oauth_provider` = '".$oauth_provider."' AND `oauth_uid` = '".$oauth_uid."'") ;//or die(mysql_error($this->connect));

		if(mysqli_num_rows($prev_query)>0){
			header('Location:mid.php');
		}
		$query = mysqli_query($this->connect,"SELECT * FROM `$this->table_name` WHERE `oauth_provider` = '".$oauth_provider."' AND `oauth_uid` = '".$oauth_uid."'");
		$result = mysqli_fetch_array($query);
		return $result;
	}

	
}


function connect(){
$servername = "localhost";
$username = "csinseew_tech15";
$password = "rSyP1^7&~(c{rhHX}p";
$dbname = "csinseew_enigmata";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}return $conn;
}

function loggedin()
{
return (bool)(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true);
}

?>