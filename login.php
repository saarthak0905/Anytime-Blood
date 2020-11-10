<?php
require 'sqlcon.php';
session_start();

$username = $_POST['user'];
$password = $_POST['pwd'];
if(isset($_POST['donorsubmit']))
{
 

    $sql="select * from donor where Email_ID='".$username."'AND Password='".md5($password)."' limit 1";

    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $_SESSION['user'] = $username;
        $_SESSION['type'] = 'donor';
        echo "".$_SESSION['user']."";

        echo "<script>
      alert('Logged in successfully!')
      window.location.href='homepage.php';
      </script>";

    }
    else{
      echo "<script>
      alert('Incorrect Credentials! Please Try Again.');
      window.location.href='login.html';
      </script>";
    }

  
}
if(isset($_POST['orgsubmit']))
{
  $sql="select * from Organization where Email_ID='".$username."'AND Password='".md5($password)."' limit 1";

  $result=mysqli_query($conn, $sql);

  if(mysqli_num_rows($result)==1){
      $_SESSION['user'] = $username;
      $_SESSION['type'] = 'org';
      echo "".$_SESSION['user']."";

      echo "<script>
    alert('Logged in successfully!')
    window.location.href='homepage.php';
    </script>";

  }
  else{
    echo "<script>
    alert('Incorrect Credentials! Please Try Again.');
    window.location.href='login.html';
    </script>";
  }


}
