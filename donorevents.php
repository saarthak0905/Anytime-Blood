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
echo "<style>table {
  border-collapse: collapse;
  width: 90%;
  margin:200px auto;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
tr:nth-child(odd){background-color: rgb(148, 148, 139);}


th {
  background-color: #7a271c;
  color: white;
td a:active{
  transform: scale(0.75) perspective(1px)
}
</style>";
$user = $_SESSION['user'];
if(isset($_SESSION['user']) AND $_SESSION['type'] == 'donor')
{
  $date_now = date("Y-m-d");
  $query = "select e.Event_ID, e.event_name, o.Name, e.Date, e.Location, e.Time, e.Blood_req, e.Description, p.Registration_time from Event e, Organization o, Participants p where e.Org_email = o.Email_ID and p.participant_email = '$user' and e.Event_ID =p.Event_ID  order by e.Date";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
   

    echo "<table>";
    echo "<tr><th>EVENT ID</th> <th>EVENT NAME</th><th>ORGANIZATION</th>  <th>DATE</th> <th>LOCATION</th>  <th>TIME</th> <th>SPECIFIC BLOOD REQUIREMENT</th><th>EVENT DESCRIPTION</th> <th>REGISTRATION TIME</th><th>WITHDRAW</th></tr>";

    while($row = mysqli_fetch_assoc($result)) {
      if ($date_now > $row['Date'] AND  time() >= strtotime($row['Time'])) {
        echo "<tr><td>" . $row['Event_ID'] . "</td><td>" .$row['event_name']. "</td><td>" .$row['Name']. "</td><td>" .$row['Date']."</td><td>".$row['Location']. "</td><td>" .$row['Time']. "</td><td>" .$row['Blood_req']. "</td><td>" .$row['Description']. "</td><td>".$row['Registration_time']."</td><td> Event Expired </td></tr>";
        
    }
    
    else{
      echo "<tr><td>" . $row['Event_ID'] . "</td><td>" .$row['event_name']. "</td><td>" .$row['Name']. "</td><td>" .$row['Date']."</td><td>".$row['Location']. "</td><td>" .$row['Time']. "</td><td>" .$row['Blood_req']. "</td><td>" .$row['Description']. "</td><td>".$row['Registration_time']."</td><td><a style = 'text-decoration: none; font-weight: bold; text-transform: uppercase; background-color: red; color: black; border: solid black 2px; padding:5px; border-radius: 10px; '  href='withdraw.php?event=".$row['Event_ID']."' class='del'>Withdraw</a></td></tr>";

     
        
    }
    }
    echo "</table><br>";
  }
  else{
    echo " <form action='donornewevent.php'>
          <div class='form-input' style = 'padding: 10px;'>  
          <center><h2 style = 'color: white;'>No Events Registered Yet. </h2></center>
          <center><button class='btn' style='width: 40%; margin:100px auto;font-size: 20px'>SEE HOSTED EVENTS</button></center>    
          </div>
          </form>";
    
  }
  echo "<form action='homepage.php'>
          <div style = 'padding: 10px;'>   
           <center><button class='btn' style='width: 10%; margin: auto;font-size: 16px'> ← BACK </button></center>
          </div>
        </form>";


//View created events in table format, register option for each event. closed events for those which have expired
}
else{
  echo "<script>window.location.href = 'logout.php'</script>";

}
?>
