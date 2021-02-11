<?php
$servername = "mysql.agh.edu.pl:3306";
$username = "rojowska";
$password = "pass";
$dbname = "rojowska";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$medicine = $_POST['medicine'];
$dose = $_POST['dose'];
$time_of_day = $_POST['time_of_day'];

$sql = "INSERT INTO Medicines (medicine, dose, time_of_day)
VALUES ('$medicine','$dose', '$time_of_day')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("refresh: 1; url=medicines.php");
