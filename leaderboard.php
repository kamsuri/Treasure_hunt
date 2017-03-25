<?php
include_once("includes/functions.php");
require_once 'inc/function.inc.php';
if(!isLoggedin()){

  header("Location: index.php");

}?>

<html>
<link rel="stylesheet" type="text/css" href="css/cardio.css">
<style>
body{
    background:url(img/footer.jpg);
    background-attachment: fixed;
}
table { text-align: center;
color: #333;
font-family: Helvetica, Arial, sans-serif;
width: 640px; 
border-collapse: 
collapse; border-spacing: 0; 
}

td, th { 
border: 1px solid transparent; /* No more visible border */
height: 30px; 
transition: all 0.3s;  /* Simple transition for hover effect */
}

th {
background: #DFDFDF;  /* Darken header a bit */
font-weight: bold;
}

td {
background: #FAFAFA;
text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */ 
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */ 
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; } /* Hover cell effect! */
</style>
</html>
<?php
include_once("includes/functions.php");
$conn=connect();
?>
<body>
<center>
<table>
     <tr>
        <th>Name</th>
        <th>College</th>
        <th>Current Level</th>
        <th>Score</th>
    </tr>
     <?php

        $result = mysqli_query($conn,"SELECT `fname`, `lname`,`college`,`current_level` FROM `users` ORDER BY current_level DESC");
        $rank = 1;

        if(mysqli_num_rows($result)>0){
            while ($row =mysqli_fetch_array($result)) {$score=($row['current_level']-1)*100;
                echo "<tr><td>".$row['fname']." ".$row['lname']."</td><td>".$row['college']."</td><td>".$row['current_level']."</td><td>".$score."</td></tr>";
                $rank++;
            }
        }    ?>
    </table>
    <a href="home.php" style="float:right;font-size:23px;" class="btn btn-blue">Home</a><br/><br/><br/><br/>
            <a href="logout.php?logout" style="float:right;font-size:23px;" class="btn btn-blue">Logout</a>
   
</center>
</body>