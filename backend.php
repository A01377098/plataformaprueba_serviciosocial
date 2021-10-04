<?php
$servername = "localhost";
$username  = "id17679843_userhaci";
$password = "J#sZ5~a+dT41K(lX";
$dbname = "id17679843_dbphaci";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*$usernombre = $_POST['usernombre'];
$useremail = $_POST['useremail'];
$userpassword = $_POST['userpassword'];*/

$strData = $_POST['strData'];
$dataDecode64 = base64_decode($strData);
$dataDecodeJson = json_decode($dataDecode64);
$usernombre = $dataDecodeJson->{'usernombre'};
$useremail = $dataDecodeJson->{'useremail'};
$userpassword = $dataDecodeJson->{'userpassword'};

$sql = "INSERT INTO user_pHaCi (nameUhc, emailUhc, pwUhc) VALUES ('$usernombre', '$useremail', '$userpassword');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
$conn->close();
?>