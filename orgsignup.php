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
  $estd = $_POST['estd'];
  $type = $_POST['orgtype'];
  
  $result = mysqli_query($conn, "select Email_ID from Organization");
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      if($row['Email_ID'] == $email){
        echo "<script>
        alert('An Organization with Same Email ID Already exists!');
        window.location.href='orgsignup.html';
        </script>";
      }
    }
  }
  if(strcmp($password, $repass)!=0)
  {
    echo "<script>
    alert('Password Mismatch!');
    window.location.href='orgsignup.html';
    </script>";
  }
  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
    echo "<script>
    alert('Password Requirement: 8-12 characters, Atleast a letter and a number,Special Characters if any:  !@#$%');
    window.location.href='orgsignup.html';
    </script>";
 }
  $hashpwd = md5($password);
   
  $sql = "Insert into Organization values(?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssss", $name, $email, $type, $address, $phone, $hashpwd, $estd);
  if ($stmt->execute()) { 
    echo "<script>
        alert('Organization registered successfully! May God Bless your cause.');
        window.location.href='login.html';
        </script>";
 } else {
    echo "Error Occured!";
 }
}