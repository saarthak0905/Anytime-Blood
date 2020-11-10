
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

require 'sqlcon.php';
session_start();
if(isset($_SESSION['user']) AND $_SESSION['type']=='org'){
$id = $_GET['event'];
$query = "select d.Name, d.Email_ID, d.Gender, d.Blood_Group, d.Ph_no, FLOOR(DATEDIFF(CURDATE(), d.DOB) / 365.25) as Age, p.Registration_time from Donor d, Participants p where p.Event_ID = '$id' AND p.participant_email = d.Email_ID;";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
  echo "<table style = 'margin:200px auto; width: 60%; padding: 5px; border: 2px solid black' >";
  echo "<tr style = 'border: 1px solid black;'><th style = 'border: 1px solid black;'>NAME</th> <th style = 'border: 1px solid black;'>EMAIL ID</th> <th style = 'border: 1px solid black;'>GENDER</th><th style = 'border: 1px solid black;'>BLOOD GROUP</th><th style = 'border: 1px solid black;'>PHONE NUMBER</th><th style = 'border: 1px solid black;'>AGE</th><th style = 'border: 1px solid black;'>REGISTRATION TIME</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr style = 'border: 1px solid black;'><td style = 'border: 1px solid black;'>".$row['Name'] . "</td><td style = 'border: 1px solid black;'>".$row['Email_ID']. "</td><td style = 'border: 1px solid black;'>".$row['Gender']."</td><td style = 'border: 1px solid black;'>".$row['Blood_Group']."</td><td style = 'border: 1px solid black;'>".$row['Ph_no']."</td><td style = 'border: 1px solid black;'>".$row['Age']."</td><td style = 'border: 1px solid black;'>".$row['Registration_time']."</td></tr>"; 
  }
  echo "</table><br>";
}
else
{
  echo "<h2 style = 'color: white; margin-top:200px'><center>NO PARTICIPANTS YET.</center></h2>";
}
echo "<form action='orgevents.php'>
          <div style = 'padding: 10px;'>   
           <center><button class='btn' style='width: 10%; margin: auto;font-size: 16px'> ← BACK </button></center>
          </div>
        </form>";
}
else{
  echo "window.location.href='login.html'";
}

?>