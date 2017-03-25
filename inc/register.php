
<html>
	<head>
		<title>REGISTRATION PAGE</title>
	</head>
	<body>
		<h2>Registration Page</h2>
		<form action="register.php" method="post">
			Enter Username: <input type="text" name="username" required="required"/> <br/>
			Enter email-id: <input type="text" name="emailid" required="required"/> <br/>
			Enter Password: <input type="password" name="password" required="required" /> <br/>
			<input type="submit" value="Register"/>
		</form>

	</body>
</html>

<?php
$error_message = array(
	"Username has already been taken!",
	"Successfully registered!",
	"Invalid email format",
	);
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysql_real_escape_string($_POST['username']);
	$email_id=mysql_real_escape_string($_POST['emailid']);
	$password = mysql_real_escape_string($_POST['password']);
    $bool = true;
     require_once 'inc/connection.inc.php';
	
	$query = mysql_query("Select * from users"); 
	while($row = mysql_fetch_array($query))
	{
		$table_users = $row['username']; 
		if($username == $table_users) 
		{
			$bool = false; 
			$error=0;
			
		}
	}
	if (!(preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $email_id))) {
 $error=2; 
 $bool=false;
}

	if($bool) 
	{
		mysql_query("INSERT INTO users (username,email_id,password) VALUES ('$username','$email_id','$password')");
	    $error=1;
}
}

 
	if(isset($error)){
		$message_style = ($error == 4) ? 'success' : 'danger';
		echo '<div class="alert alert-' . $message_style . ' alert-dismissible" style="margin:10px 10px -10px 10px ;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$error_message[$error].'</div>';
	}
?>	
