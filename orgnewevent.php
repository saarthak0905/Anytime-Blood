<?php
require 'sqlcon.php';
session_start();
if(isset($_SESSION['user']) && $_SESSION['type']=='org')
{
  if(isset($_POST['name']))
  {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $orgmail = $_SESSION['user'];
    $location = $_POST['address'];
    $description = $_POST['description'];
    $bg = $_POST['blood'];
    $date_now = date("Y-m-d");
    $id = substr($orgmail,0,3);
    $digits = 3;
    $num = rand(pow(10, $digits-1), pow(10, $digits)-1);
    $id.=$num;
    echo $id;
    if($date_now > $date AND time() > strtotime($time))
    {
      echo "<script>
      alert('Cannot travel to the past to create event! Event date and Time must be in future');
      window.location.href='orgnewevent.html';
      </script>";
    }
  
      $sql = "Insert into Event(Event_ID, event_name, Org_email, Date, Location, Time, Blood_req, Description) values(?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssssss", $id, $name, $orgmail, $date, $location, $time, $bg, $description);
      if ($stmt->execute()) { 
        echo "<script>
            alert('Event Was Created Successfully');
            window.location.href='homepage.php';
            </script>";
      } 
    else {
        echo mysqli_error($conn);
    }
    
    
    
    
    
    
   
  }
}
else{
  echo "<script>window.location.href = 'logout.php'</script>";
}