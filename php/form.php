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

$name = $date = $location = $category = $time = $organization = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = test_input($_POST["name"]);
    $organization = test_input($_POST["organization"]);
    $time = test_input($_POST["time"]);
    $date = test_input($_POST['date']);
    $location = test_input($_POST['location']);
    $category = test_input($_POST['category']);
    $organization = test_input($_POST['organization']);
}

$orgQuery = "SELECT organization_id FROM organization WHERE organization = '$organization';";
$result = $conn->query($orgQuery);
$row = $result->fetch_assoc();
$org_id = $row["organization_id"];

echo $org_id;


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }



$eventsql = "INSERT INTO events (name, date, organization_id, location, category, time)
 VALUES ( '$name', /*STR_TO_DATE('$date', 'YYYY/MM/DD')*/ '$date', $org_id, '$location', '$category', '$time')";
//$sql = "INSERT INTO events VALUES ('testName', STR_TO_DATE('11/20/2000', 'YYYY/MM/DD'), 1, 'testLocation', 'other', '12:30')";

if ($conn->query($eventsql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $eventsql . "<br>" . $conn->error;
}

$conn->close();

?>