<?php
$Username        = $_POST ['Username'];
$Gmail           = $_POST ['Gmail'];
$Age             = $_POST ['Age'];
$Password        = $_POST ['Password'];
$ConfirmPassword = $_POST ['ConfirmPassword']; 


if (!empty($Username) || !empty($Gmail) || !empty($Age) || !empty($Password) || !empty($ConfirmPassword))
{
    $host = "localhost";
    $dbusername = "root";
    $dppassword = " ";
    $dbname = "guvi"; 

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Gmail From signup Where Gmail = ? Limit 1";
  $INSERT = "INSERT Into signup (Username , Gmail  ,Age , Password , ConfirmPassword )values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Gmail);
     $stmt->execute();
     $stmt->bind_result($Gmail);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssiss", $Username,$Gmail,$Age,$Password,$ConfirmPassword);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
 
  
