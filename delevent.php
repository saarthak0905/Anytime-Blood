<?php
require 'sqlcon.php';
session_start();
$id = $_GET['event'];
if(isset($_SESSION['user']) && $_SESSION['type'] == 'org')
{
  if(isset($_GET['event']))
  {
    $query ="select * from Event where Event_ID='".$id."'AND Org_email='".$_SESSION['user']."' limit 1";

    $result=mysqli_query($conn, $query);

    if(mysqli_num_rows($result)==0){
           
        

        echo "<script>
      alert('Event Not Found!')
      window.location.href='deleteauction.php';
      </script>";

    }
    
    else{
      $sql = "DELETE FROM Event WHERE Event_ID = '$id'";
      $sql1 = "Delete From Participants where Event_ID = '".$id."'";
      $query1 = "select * from Participants where Event_ID = '$id'";
      $result2=mysqli_query($conn, $query);
      if(mysqli_num_rows($result)==0)
      {
        if (mysqli_query($conn, $sql)) {
          echo "<script>
        alert('Event Was Deleted Successfully!')
        window.location.href='orgevents.php';
        </script>";
        }
        else{
          echo "<script>
      alert('Error deleting the record! Try Again.')
      window.location.href='orgevents.php';
      </script>";
        }
  
      }
      else{
        if(mysqli_query($conn, $sql1) AND mysqli_query($conn, $sql)){
          echo "<script>
        alert('Event Was Deleted Successfully!')
        window.location.href='orgevents.php';
        </script>";

        }
        
       else {
        echo "<script>
      alert('Error deleting the record! Try Again.')
      window.location.href='deleteauction.php';
      </script>";
      }
      }
      


    }
  }
}


?>