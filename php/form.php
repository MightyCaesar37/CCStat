<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]);

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
$nameErr = $dateErr = $locationErr = $categoryErr = $timeErr = $organizationErr = '';
$name = $date = $location = $category = $time = $organization = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["organization"])) {
    $organizationErr = "Organization is required";
  } else {
    $organization = test_input($_POST["organization"]);
  }

  if (empty($_POST["time"])) {
    $time = "Time is required";
  } else {
    $time = test_input($_POST["time"]);
  }

  if (empty($_POST["date"])) {
    $date = "Date is required";
  } else {
    $date = test_input($_POST["date"]);
  }
    
  if (empty($_POST["location"])) {
    $location = "Location is required";
  } else {
    $location = test_input($_POST["location"]);
  }
    
 if (empty($_POST["category"])) {
    $category = "Category is required";
  } else {
    $category = test_input($_POST["category"]);
  }
    
 if (empty($_POST["organization"])) {
    $organization = "Organization is required";
  } else {
    $organization = test_input($_POST["organization"]);
  }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$eventsql = "INSERT INTO events (name, date, organization_id, location, category, time)
 VALUES ( '$name', /*STR_TO_DATE('$date', 'YYYY/MM/DD')*/ '$date', 1, '$location', '$category', '$time')";
//$sql = "INSERT INTO events VALUES ('testName', STR_TO_DATE('11/20/2000', 'YYYY/MM/DD'), 1, 'testLocation', 'other', '12:30')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
