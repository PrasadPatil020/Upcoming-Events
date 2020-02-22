<?php
$servername = "localhost";
$username = "root"; // default username for localhost is root
$password = ""; // default password for localhost is empty
$dbname = "upcomingevents"; // database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?> 

<!-- // function redirect($url)
// {
    
//     if(headers_sent())
//     {
     
//         echo "<script>window.location.href='".$url."'</script>";
//     }
//     else
//     {
     
//         header("Location: ".$url);
//     }
// }

?> -->