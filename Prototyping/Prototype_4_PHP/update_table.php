<?php
$servername = "localhost";
$username = "SSD_DB";
$password = "disability12!";
$dbname = "Clients";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// var_dump($_POST['name']); //Returns an array of all the check boxes that were clicked


$sql = "INSERT INTO client (name, email, phone, disability)
VALUES ('$_POST[name]', '$_POST[email]',  '$_POST[phone]', '')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  echo "<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br>";
}

// Print all the clients
$query = "SELECT name FROM client";
$response = @mysqli_query($conn, $query);
if($response){
	while($row = mysqli_fetch_array($response)){
		echo $row['name'];
		echo "<br>";
	}
}

$conn->close();
?>