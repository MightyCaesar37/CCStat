<?php
$servername = "localhost";
$username = "root";
$password = "qpal10-@";
$dbname = "events";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$name = $organization = $time = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = test_input($_POST["name"]);
    $organization = test_input($_POST["organization"]);
    $time = test_input($_POST["time"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  


$sql = "INSERT INTO events (name, time, orginization_id)
VALUES ('Test', '9999-12-31 23:59:59', 1)";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>