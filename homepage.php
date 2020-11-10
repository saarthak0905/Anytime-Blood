<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Any Time Blood</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <nav class="navbar">
      <ul>
        <div class="title">
          ANY TIME BLOOD
        </div>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="faq.html">FAQs</a></li>
        <li><a href="aboutus.html">About Us</a></li>
        <li><a href="contactus.html">Contact Us</a></li>
        <li><a href="homepage.php">Home</a></li>
      </ul>
    </nav>
  </header>
</body>
</html>


<?php
session_start();
if(isset($_SESSION['user'])){
  $usertype = $_SESSION['type'];
  $user = $_SESSION['user'];

  if($usertype =='donor')
  {
    $new = "REGISTER FOR NEW EVENT";
    $newurl = 'donornewevent.php';
    $existing = "VIEW REGISTERED EVENTS";
    $existingurl = 'donorevents.php';
  }
  else if($usertype == 'org')
  {
    $new = "CREATE NEW EVENT";
    $existing = "VIEW EXISTING EVENTS";
    $newurl = 'orgnewevent.html';
    $existingurl = 'orgevents.php';
  }
  echo "<div class ='logincontainer' style = 'padding: 20px; width: 20%;'>";
        echo "<form action='$newurl'>
            <div class='form-input' style = 'padding: 10px;'>      
            <button class='btn' style='width: 100%; margin:0 auto;font-size: 20px'>$new</button>
            </div>
          </form>";
          echo "<h1><center>OR</center></h1>";
          echo"<form action='$existingurl'>
            <div class='form-input' style = 'padding: 10px;'>
              <button class='btn' style='width: 100%;  margin: 0 auto;font-size: 20px'>$existing</button>
            </div>
          </form>";
  echo "</div>";
}
else{
  echo "<script>
        window.location.href='login.html';
        </script>";
 }
?>