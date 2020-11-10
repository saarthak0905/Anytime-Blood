<?php
require 'sqlcon.php';

if(isset($_POST['email']))
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $repass = $_POST['cpwd'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $dob = $_POST['age'];
  $bg = $_POST['blood'];
  $gender = $_POST['gender'];
  /*echo $name;
  echo $email;
  echo $phone;
  echo $address;
  echo $dob;
  echo $bg;
  echo $gender;*/


  $result = mysqli_query($conn, "select Email_ID from donor");
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      if($row['Email_ID'] == $email){
        echo "<script>
        alert('A Donor with Same Email ID Already exists!');
        window.location.href='usersignup.html';
        </script>";
      }
    }
  }
  if(strcmp($password, $repass)!=0)
  {
    echo "<script>
    alert('Password Mismatch!');
    window.location.href='usersignup.html';
    </script>";
  }
  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
    echo "<script>
    alert('Password Requirement: 8-12 characters, Atleast a letter and a number,Special Characters if any:  !@#$%');
    window.location.href='usersignup.html';
    </script>";
 }
  $hashpwd = md5($password);
   
  $sql = "Insert into donor values(?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $bg, $email, $name, $phone, $gender, $address, $hashpwd, $dob);
  if ($stmt->execute()) { 
    echo "<script>
        alert('Donor was registered successfully! Happy Donating.');
        window.location.href='login.html';
        </script>";
 } else {
    echo "Error Occured!";
 }
}