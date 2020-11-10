<?php
require 'sqlcon.php';
session_start();
$id = $_GET['event'];
$user = $_SESSION['user'];
if(isset($_SESSION['user']) && $_SESSION['type'] == 'donor')
{
  $query1 = "select e.Time, e.Date from Event e, Participants p, donor d where e.Event_ID = p.Event_ID AND p.participant_email = d.Email_ID AND d.Email_ID = '$user'";
  $query2 = "select Time, Date from Event where Event_ID = '$id' limit 1";
  $result2 = mysqli_query($conn, $query2);
  $result = mysqli_query($conn,$query1);
  $clash = 'no';
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $datearray = array();
    $timearray = array();
    while($row = mysqli_fetch_assoc($result)) {
      echo $row['Date'];
      echo $row['Time'];
      $datearray[] = $row['Date'];
      $timearray[] = $row['Time'];
    }
    if(mysqli_num_rows($result2)>0)
    {
      while($row1 = mysqli_fetch_assoc($result2)) {
        if(in_array($row1['Time'], $timearray) AND in_array($row1['Date'], $datearray))
        {
          $clash = 'yes';
          echo "<script>
        alert('Cannot Commit to this event. You are already registered for another event at the same date and time!');
        window.location.href='homepage.php';
        </script>";
        }
        

    }
  }
}
  if($clash!='yes'){
  $query = "insert into Participants values(?, ?, now())";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $user, $id);
  if ($stmt->execute()) { 
    echo "<script>
        alert('Registered for Event!');
        window.location.href='donornewevent.php';
        </script>";
 } else {
    echo "Error Occured!";
 }
}
}
else{
  echo "<script>window.location.href='login.html'</script>";
}



?>