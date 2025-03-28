<?php
/*
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
*/

/*
$host = "localhost";
$user = "root"; // Change if using a different username
$pass = "mr.dharmik31"; // Change if using a password
$db = "login_system";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "success";
}
*/
//session_start();

$servername = "localhost";
$user = "root";
$password = "";
$db = "hackathon";

if(!isset($conn)){  
$conn = new mysqli($servername,$user,$password,$db);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}
// if($conn){
//     echo "<script>alert('Database is connected');</script>";
// }
if($conn -> connect_error){
    die("Connection failed: " . $conn->connection->error);
}
// $query = "CREATE DATABASE hackathon";
// mysqli_query($conn,$query);
?> 



?>
