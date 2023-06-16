<?php
// Database configuration
$server = 'localhost';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'Employee'; // Replace with your database name

// Create a connection to the database
$connection = mysqli_connect($server, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());}
// }else{
//     echo'connected';
// }
// $sql = "SELECT * FROM users";
// $result = mysqli_query($connection, $sql);

// if (!$result) {
//     die("Query failed: " . mysqli_error($connection));
// }

// while ($row = mysqli_fetch_assoc($result)) {
//     echo "ID: " . $row['id'] . "<br>";
//     echo "Username: " . $row['username'] . "<br>";
//     echo "Email: " . $row['email'] . "<br>";
//     echo "Password: " . $row['password'] . "<br>";
//     echo "Picture: " . $row['picture'] . "<br><br>";
// }

// mysqli_free_result($result);
// mysqli_close($connection);

?>
