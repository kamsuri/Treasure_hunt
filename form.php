 <?php
 error_reporting(-1);
 session_start();
 include_once("config.php");
include_once("includes/functions.php");
 $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
  $user = new Users();
  $user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender']);
  if(empty($user_data)){
        $output .= '<br/>Logout from <a href="logout.php?logout">Facebook</a>';
if(isset($_POST['submit']))
{
$email=$_POST['email'];
$mob=$_POST['mob'];
$collg=$_POST['collg'];
$_SESSION['email']=$email;
$_SESSION['mobile']=$mob;
$_SESSION['college']=$collg;
$conn=connect();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql="INSERT INTO `users`(`oauth_provider`,`oauth_uid`,`fname`,`lname`,`emailid`,`gender`,`mobile`,`college`)
VALUES('{$_SESSION['oauth_provider']}','{$_SESSION['oauth_uid']}','{$_SESSION['first_name']}','{$_SESSION['last_name']}','{$_SESSION['email']}','{$_SESSION['gender']}','{$_SESSION['mobile']}','{$_SESSION['college']}')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header('Location:home.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>

<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">
<head> 
 <meta charset="UTF-8">
 <title>Register|Enigmata</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600,700,300'>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="js/prefixfree.min.js"></script>
  </head>
<body>
<div class="wrap">
  
  <div class="flip-container" id='flippr'>
    <div class="flipper">
      <div class="front"></div>
      <div class="back"></div>
    </div>
  </div>
  
  <h1 class="text" id="welcome">Welcome. <span>please update your information.</span></h1>
  <form method="POST">
        <input type="text" name="name" value="<?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?> " readonly></input>
      <input type="email"  name="email" value="<?php echo $_SESSION['emailid'];?>" ></input>
      <input type="text" name="mob" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" maxlength="10" value="Mobile no" pattern="[789][0-9]{9}" required></input>
      <input type="text" name="collg" placeholder="College"required></input>
     <input type="text" name="gender" value="<?php echo $_SESSION['gender']; ?>" readonly></input>
      <br/>
      <button type="submit" name="submit">Submit</button>
  </form>
  <?php
echo $output;
  ?>
</div><!-- /wrap -->



    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>

    </html>
    <?php
  }else{
    $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    //echo $output;
  }
  