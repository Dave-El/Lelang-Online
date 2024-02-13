<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'lelang_online';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set the character set
$conn->set_charset("utf8");

// The connection is established, and you can use $conn for your queries

// Note: It's generally a good practice to close the database connection when you're done with it,
// but in many cases, it's not necessary as PHP automatically closes it when the script finishes.

// Close the connection (optional)
// mysqli_close($conn);
?>
