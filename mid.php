<?php
session_start();
include_once("includes/functions.php");
require_once 'inc/layout/stylesheets.inc.php';
require_once 'inc/login_functions.inc.php';
require_once 'inc/function.inc.php';
$conn=connect();
$query="SELECT `user_id`,`current_level`,`disqualified` FROM `users` WHERE `oauth_uid`='{$_SESSION['oauth_uid']}'";
      $query_row = mysqli_fetch_assoc(mysqli_query($conn, $query));
      if(isset($query_row['user_id'])){
            $_SESSION['user_id']    = $query_row['user_id'];
        $_SESSION['current_level']  = $query_row['current_level'];
        $_SESSION['disqualified']   = $query_row['disqualified'];
         $check="SELECT * FROM `user_entry_log` WHERE `user_id`='{$_SESSION['user_id']}'";
             $check_row = mysqli_fetch_assoc(mysqli_query($conn, $check));
       if(isset($check_row['id'])){$time=time();
       $upd="UPDATE `user_entry_log` SET `timestamp`='$time' WHERE `id`='{$check_row['id']}'";
        mysqli_query($conn,$upd);
        }
  
    else{$time=time();
    $ins="INSERT INTO `user_entry_log`(`user_id`,`current_level`,`timestamp`) VALUES ('{$_SESSION['user_id']}','{$_SESSION['current_level']}','$time')";
        mysqli_query($conn,$ins);
        }
    header("Location:home.php");
  }
   else {
    $error = 1;
    $message = "Something's wrong!";
  } 
?>