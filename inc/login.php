<html>
<?php
session_start();
if(isset($_SESSION['error']))
$err = $_SESSION['error'];
?>
     <head>
		<title>LOGIN</title>
	</head>
	<body>
		<h2>Login Page</h2>
		<a href="index.php">Click here to go back</a><br/><br/>
		<form action="checklogin.php" method="post">
			<?php 
           if(isset($err))
           echo "$err";
           unset($_SESSION['error']);
           ?><br><br>
			Enter Username: <input type="text" name="username" required="required"/> <br/>
			Enter Password: <input type="password" name="password" required="required" /> <br/>
			<input type="submit" value="Login"/>
           
		</form>
	
	</body>
</html>