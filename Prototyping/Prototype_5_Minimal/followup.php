<!DOCTYPE html>
<html>
    
    <head>
        <title>SSD Listings Survey</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="app.js" defer></script>

        <link rel="stylesheet" href="style.css" />  <!-- Check with Doug --> 

        <!-- Add Bootstrap Style Sheet (for buttons) --> 
        <link rel="bootstrap stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 
    </head>

<body>

<div class="container">
  
  <div class="page-header">
    <h1 style="text-align:center">Followup Questions</h1>


<!--   <div class="container">
    <div class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="6.66" aria-valuemin="0" aria-valuemax="100" style="width:6.66%"></div>
    </div>
  </div> -->

</div>

<!-- Load Previous data into session using PHP -->
<?php

// Connect to server

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


session_start();
$_SESSION['primary_checked_boxes'] = $_POST['check_list[]'];

echo $_SESSION['primary_checked_boxes'];


$sql = "INSERT INTO client (name, age, email, phone, primary_checked_boxes)
VALUES ('$_SESSION[name]','$_SESSION[age]','$_SESSION[email]', '$_SESSION[phone]','$_SESSION[primary_checked_boxes]')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  echo "<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br>";
}

// Print all the clients
$query = "SELECT primary_checked_boxes FROM client";
$response = @mysqli_query($conn, $query);
if($response){
  while($row = mysqli_fetch_array($response)){
    echo $row['name'];
    echo "<br>";
  }
}

$conn->close();



// // // Store variables from previous form as session vars
// // $_SESSION['primary_checked_boxes'] = $_POST['check_list'];

// // Now submit to the database
// $insert_query = 'insert into client (
//         name,
//         age,
//         email
//         phone,
//         primary_checked_boxes
//             ) values (
//         " . $_SESSION['name'] . ",
//         " . $_SESSION['age'] . ",
//         " . $_SESSION['email'] . ",
//         " . $_SESSION['phone'] . ",
//         " . $_POST['check_list'] . "
//             );'

// // Lets run the query
// mysql_query($insert_query);

// if ($conn->query($insert_query) === TRUE) {
//   echo "New record created successfully";
//   echo "<br>";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
//   echo "<br>";
// }



// // if(!empty($_POST['check_list']))
// // {
// //      foreach($_POST['check_list'] as $id){
// //       array_push($_SESSION[checked_boxes],id);
// //       echo "<br>$id was added! ";
// //      }
// // }


// $conn->close();


?>

<!-- Mental Disorders Primary Questionnaire -->

<form class="form-horizontal" action="16_Summary.html" method="post">

  <h4>Please answer the following questions to the best of your ability:</h4>

  <div id="myDIV" style="display:none">
    <label><input type="checkbox"> Followup Question</label>
  </div>

<!--   <div class="hidden_checkbox" style="display:none" id="12.02_test">
      <label><input type="checkbox" name="1.02"> Have you experienced a significant decline in your mental abilities over the years? (12.02)</label>
      <br>
  </div>
  <br> -->


  <button type="submit" class="pager_copy" formaction="mental_copy.php">Previous</button>
  <button type="submit" class="pager_copy">Next</button>


</form> 

</div>
</body>
</html>




