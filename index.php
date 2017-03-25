<?php
	error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">
<head> 
<script type="text/javascript" src="js/home.js"></script>
<?php
	//require_once 'inc/connection.inc.php';
	require_once 'inc/login_functions.inc.php';
	require_once 'inc/function.inc.php';

	require_once 'inc/layout/stylesheets.inc.php';
	require_once 'inc/layout/scripts.inc.php';
?>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Enigmata</title>
	<meta name="description" content="Enigmata is an online treasure hunt organised by CSI-NSIT as part of their annual fest Techelon.Techelon'16 is in association with Innovision'16 (techn0-managerial fest of NSIT" />
	<meta name="keywords" content="Enigmata, Online Treasure hunt, Techelon'16,CSI NSIT, NSIT, Innovision'16" />
	<meta name="author" content="CSI NSIT" />
	<!-- Favicons (created with http://realfavicongenerator.net/)-->
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-touch-icon-60x60.png">
	<link rel="icon" type="image/png" href="img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="img/favicons/manifest.json">
	<link rel="shortcut icon" href="img/favicons/favicon.ico">
	<meta name="msapplication-TileColor" content="#00a8ff">
	<meta name="msapplication-config" content="img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!-- Normalize -->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!-- Owl -->
	<link rel="stylesheet" type="text/css" href="css/owl.css">
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.1.0/css/font-awesome.min.css">
	<!-- Elegant Icons -->
	<link rel="stylesheet" type="text/css" href="fonts/eleganticons/et-icons.css">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="css/cardio.css">
	<link href='https://fonts.googleapis.com/css?family=Exo+2:400,900|Roboto:400,900' rel='stylesheet' type='text/css'>
	<style>
	body {
		font-family: 'Roboto', sans-serif;
	}
	</style>
</head>

<?php
	session_start();
	require_once("config.php");
	require_once("includes/functions.php");
	//destroy facebook session if user clicks reset
	if(!$fbuser){
  $fbuser = null; 
  $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
  $output ='<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>';
 ?>
<body>
	<div class="preloader">
		<img src="img/loader.gif" alt="Preloader image">
	</div>
	<header id="intro">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3 class="light white"><strong>CSI NSIT</strong> presents</h3>
							<h1 class="white typed"><em>Enigmata</em> - Online Treasure Hunt</h1>
							<span class="typed-cursor">|</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php

echo '<section>
		<div class="cut cut-top"></div>
		<div class="container">
			<div class="row intro-tables">
		
				
				<div class="col-md-4" style="width:50%;">
					<div class="intro-table intro-table-hover">
						<h5 class="white heading hide-hover">Login</h5>
						<div class="bottom">
							<h4 class="white heading small-heading no-margin regular">Good luck!</h4>
							<div class="btn btn-white-fill expand">' . $output . '</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>';
 ?>
	
	
	<div class="footer">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-6 text-center-mobile">
					<h3 class="white">Competition's On! <span class="open-blink"></span></h3>
				</div>
			</div>
			<div class="row bottom-footer text-center-mobile">
				<div class="col-sm-8">
					<p>&copy; 2016 All Rights Reserved. Powered by <a href="http://techelon.csinsit.org/">Techelon'16</a> </p>
				</div>
				<div class="col-sm-4 text-right text-center-mobile">
					<ul class="social-footer">
						<li><a href="https://web.facebook.com/events/848428311968966/"><i class="fa fa-facebook"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Holder for mobile navigation -->
	<div class="mobile-nav">
		<ul>
		</ul>
		<a href="#" class="close-link"><i class="arrow_up"></i></a>
	</div>
</div>
	<!-- Scripts -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/typewriter.js"></script>
	<script src="js/jquery.onepagenav.js"></script>
	<script src="js/main.js"></script>

<div>  
</div>	
</body>
</html>
<?php
}else{
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
    header('Location:mid.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>

<html>
 <meta charset="UTF-8">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600,700,300'>

        <style>
body {
  width: 100%;
  height: 100%;
}
body {
  margin: 0 auto;
  display: table;
  text-align: center;
  font-family: 'Open Sans', sans-serif;
  background: #81b5d6;
  max-width: 33em;
}
.wrap {
  margin-top:50px;
}

.flip-container {
  perspective: 1000;
  border-radius: 50%;
  margin: 0 auto 10px auto;
}

.logged-in {
  transform: rotateY(180deg);
}

.flip-container, .front, .back, .back-logo {
  width: 130px;
  height: 130px;
}

.flipper {
  transition-duration: 0.6s;
  transform-style: preserve-3d;
}

.front, 
.back {
  backface-visibility: hidden;
  position: absolute;
  top: 0;
  left: 0;
  background-size: cover;
}

.front {
  background: url(img/user2.png) 0 0 no-repeat;
}

.back {
  transform: rotateY(180deg);
  background: url(img/user2.png) 0 0 no-repeat;
}

h1 {
  font-size: 22px;
  color: #FFF;
}
h1 span {
  font-weight: 300;
}
input[type=text],
input[type=email] {
  color:#FFF;
  background: #68add8; /* Old browsers */
  background: linear-gradient(45deg,  #68add8 0%,#8cbede 100%); /* W3C */
  width:250px;
  height:40px;
  margin: 0 auto 10px auto;
  font-size:14px;
  padding-left:15px;
  border:none;
  box-shadow: -3px 3px #679acb ;
  -webkit-appearance:none;
  border-radius:0;
  border-top: 1px solid #92c5e2;
  border-right: 1px solid #92c5e2;
}
input::-webkit-input-placeholder { 
  color: #FFF;
}
input:focus {
  outline:none;
}
input[type=submit] {
    color: #fff;
    background-color:#3f88b8;
    font-size: 14px;
    height: 40px;
    border: none;
    margin: 0 auto 0 17px;
    padding: 0 20px 0 20px;
    -webkit-appearance:none;
    border-radius:0;
    cursor: pointer;
}
input[type=submit]:hover {
  background-color:#3f7ba2;
}
a {
  color:#1c70a7;
  font-weight:600;
  font-size:12px;
  text-decoration:none;
}
a:hover {
  color:#3f7ba2;
}

.hint
{
  width:250px;
  dislay:block;
  margin:80px auto 0 auto;
  text-align:left;
}

.hint p
{
  padding: 5px 0 5px 0;
  color:#FFF;
  font-weight:600;
  font-size:20px;
}

.hint p span
{
  font-weight:300;
  font-size:16px;
}

    </style>

    
        <script src="js/prefixfree.min.js"></script>

    
  </head>

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
  
}
?>

</div>
</body>
</html>
