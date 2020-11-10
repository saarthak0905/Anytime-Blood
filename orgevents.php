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
}</style>";
$user = $_SESSION['user'];
if(isset($_SESSION['user']) AND $_SESSION['type'] == 'org')
{
  $date_now = date("Y-m-d");
  $query = "select * from Event where Org_email = '$user' order by Date desc";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
   

    echo "<table>";
    echo "<tr><th>EVENT ID</th> <th>EVENT NAME</th>  <th>DATE</th> <th>LOCATION</th>  <th>TIME</th> <th>DELETE EVENT</th><th>VIEW PARTICIPANTS</th></tr>";
   
    while($row = mysqli_fetch_assoc($result)) {
      //if $row['Date'] < 
      if ($date_now > $row['Date'] AND time() > strtotime($row['Time'])) {
        echo "<tr><td>" . $row['Event_ID'] . "</td><td>" .$row['event_name']. "</td><td>" .$row['Date']."</td><td>".$row['Location']. "</td><td>" .$row['Time']. "</td><td>CLOSED EVENT</td><td>  <a href='viewparticipants.php?event=".$row['Event_ID']."'>View Participants</a>  </td></tr>";
        
    }else{
      echo "<tr><td>" . $row['Event_ID'] . "</td><td>" .$row['event_name']. "</td><td>" .$row['Date']."</td><td>".$row['Location']. "</td><td>" .$row['Time']. "</td><td>  <a style = 'text-decoration: none; font-weight: bold; text-transform: uppercase; background-color: red; color: black; border: solid black 2px; padding:5px; border-radius: 10px; ' href='delevent.php?event=".$row['Event_ID']."'>Delete</a>  </td><td>  <a style = 'text-decoration: none; font-weight: bold; text-transform: uppercase; background-color: darkblue; color: white; border: solid black 2px; padding:5px; border-radius: 10px; ' href='viewparticipants.php?event=".$row['Event_ID']."'>View Participants</a>  </td></tr>";
        
    }
    }
    echo "</table><br>";
  }
  else{
    echo "<form action='orgnewevent.html'>
          <div style = 'padding: 10px;'>  
          <center><h2 style = 'color: white;'>No Events Hosted Yet. </h2></center>    
           <center><button class='btn' style='width: 40%; margin:100px auto;font-size: 20px'>CREATE EVENT</button></center>
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