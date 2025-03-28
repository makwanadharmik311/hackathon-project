<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
</head>
<body>
      <script>
          alert('You are successfully Logged Out!!\nThank You for using our Service!!');
          window.location.href = 'index.php';
      </script>

</body>
</html>

<?php
session_destroy(); // Destroy session
exit(); 
//if($logout)
//header("Location: auth.php"); // Redirect to login page
?>