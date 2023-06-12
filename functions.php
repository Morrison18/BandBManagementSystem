<?php

function dbconnect() {
  $hostname = 'localhost';
  $username = 'root';
  $password = 'root';
  $dbname   = 'Mary_janes';
  
  // Creating the connection
  $conn = mysqli_connect($hostname, $username, $password) OR die('Unable to connect to the database! Please try again later.');

  if (!$conn) {
      die('Connection failed: ' . mysqli_connect_error());
  }
  
  mysqli_select_db($conn, $dbname);
  
  return $conn;
}

// Get form info
$cx_name = $_POST['cx_name'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$phone = $_POST['phone'];


// Add function adds a new record to the database 
function add($cx_name, $address, $email, $phone, $password, $gender, $conn) {
  $sql = "INSERT INTO customer (`cx_name`, `address`, `email`, `phone`, `password`, `gender`) VALUES ('$cx_name', '$address', '$email', '$phone', '$password', '$gender')";
         
  if(mysqli_query($conn, $sql)){
    echo "<h3>Data stored in the database successfully."
        . " Please browse your localhost phpMyAdmin"
        . " to view the updated data.</h3>";
 
    echo nl2br("\n$cx_name\n $password\n "
        . "$gender\n $address\n $phone\n $email");
  } else {
    echo "ERROR: Sorry, there was an issue inserting the data. "
        . mysqli_error($conn);
  }
}

$conn = dbconnect();
add($cx_name, $address, $email, $phone, $password, $gender, $conn);
mysqli_close($conn);
?>
