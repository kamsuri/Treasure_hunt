<?php
session_start();
include_once("includes/functions.php");
require_once 'inc/layout/stylesheets.inc.php';
require_once 'inc/login_functions.inc.php';
require_once 'inc/function.inc.php';
if(!isLoggedin()){
  header("Location: index.php");
}
$conn=connect();
$lastlevel=14;//last level to be filled

if($_SESSION['current_level']>$lastlevel){
$error=1;
$message="You have completed thanx for participating!!!";
}else{
       if($_SESSION['disqualified']==0)
       {$sql="SELECT * From `user_entry_log`";
       $sql_row=mysqli_fetch_assoc(mysqli_query($conn,$sql));
       if(isset($sql_row['id'])){

        $level="SELECT * FROM `levels` WHERE `level_id`='{$_SESSION['current_level']}'";
        $level_row=mysqli_fetch_assoc(mysqli_query($conn,$level));
        $link=$level_row['image'];
        $answer=$level_row['answer'];
        $timeold=$sql_row['timestamp'];
        }
        }
        else{
          $error=2;
          $message="Sorry!! you have been disqualified";
        }
        
       
}
if(isset($_POST['submit']))
        { 
          $ans1=clean_string($_POST['ans'],true);//answer taken from user
         $ans=md5($ans1);
         if($answer==$ans)
         {   $timen=time();
          if(($timen-$timeold)>10)
          {$_SESSION['current_level']+=1;
          $query1="UPDATE `users` SET `current_level`='{$_SESSION['current_level']}' WHERE `user_id`='{$_SESSION['user_id']}'";
          $query2="UPDATE `user_entry_log` SET `current_level`='{$_SESSION['current_level']}',`timestamp`='$timen' WHERE `user_id`='{$_SESSION['user_id']}'";
          mysqli_query($conn,$query1);
          mysqli_query($conn,$query2);
          header("Location:home.php");
          }
          else
          { $_SESSION['disqualified']=1;
            $query1="UPDATE `users` SET `disqualified`='1' WHERE `user_id`='{$_SESSION['user_id']}'";
            mysqli_query($conn,$query1);
            $error=2;
            $message="Seems to be in hurry huh!!you have been disqualified";
          }
         }
         else
         {
          $error=1;
          $message="Mate, thats's not the right secret code";
         }
        }


?>



<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">
		<title>Enigmata</title>
 <link rel="stylesheet" type="text/css" href="css/cardio.css">
	</head>
	
	<body background="images/hh.jpg" style="background-attachment: fixed;">
    <br/><br/>
    <nav class="navbar" style="background-color:white;">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
        
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
         <h6 style="font-size:8px;color:white;display:inline;">With power comes responsibility</h6>
       <p style="font-size:20px;color:#00a8ff;padding-top:15px;"> Hello <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']?>!</p>
      
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right main-nav">

          <li><a href="logout.php?logout" style="font-size:18px;">Logout</a></li>
          <li><a href="leaderboard.php" data-toggle="modal" data-target="#modal1" class="btn btn-blue">Leaderboard</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
    <!--shutdowninattheend -->
		<!-- <p style="font-size:35px;color:#000;">Hello <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']?>!</p> 
		<a href="logout.php?logout" style="float:right;font-size:23px;">Click here to logout</a><br/><br/>
    <a href="leaderboard.php" style="float:right;font-size:23px;">Leaderboard</a><br/><br/>
     -->
       <div class="container">
<?php

if(isset($error)){
	echo '<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top:110px;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>' . $message . '</div>';
}if($error!=2){
?>
<div class="design" style="text-align:center">
  <div class="level" style="background-color:#fff;height:45px;;width:15%;border:0px;border-radius:5px; margin-left:45%;margin-top:95px;margin-bottom:5%;">
<p style="font-size:30px;color:#00a8ff; text-align:center;">LEVEL:<?php echo "{$_SESSION['current_level']}"?></p>
</div>

<p style="font-size:25px;color:black;"><div class="btn btn-blue">QUESTION:</div><img src="<?php echo $link ?>" width="50%"></p>
       <form method="POST">
<input type="text" name="ans" required class="input"></input><br/><br/>
<button type="submit" name="submit" class="btn btn-blue" style="width: 130px;margin-left: 97px;">Submit</button>
       </form>
     </div>
     </div>
     <?php
   }
     ?>
        </body>
</html>
<!--in2008-->

