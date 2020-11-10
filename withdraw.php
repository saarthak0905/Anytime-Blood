<?php
require 'sqlcon.php';
session_start();
$id = $_GET['event'];
$user = $_SESSION['user'];
if(isset($_SESSION['user']) && $_SESSION['type'] == 'donor')
{
  $query =  "DELETE FROM Participants WHERE Event_ID = '$id' and participant_email = '$user'";
  
  if (mysqli_query($conn, $query)) { 
    echo "<script>
        alert('You have Withdrawn from an event');
        window.location.href='donorevents.php';
        </script>";
 } else {
    echo "Error Occured!";
 }
}

?>