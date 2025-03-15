<?php

$host = "localhost";
$user = "root"; // Change if using a different username
$pass = "mr.dharmik31"; // Change if using a password
$db = "hackathonproject";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{

}

?>
