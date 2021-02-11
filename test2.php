<?php
$servername = "mysql.agh.edu.pl:3306";
$username = "rojowska";
$password = "pass";
$dbname = "rojowska";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT medicine, dose, time_of_day, reading_time FROM Medicines ORDER BY id DESC";

if ($result = $conn->query($sql)) {
    $response["Medicines"] = array();

    while ($row = $result->fetch_assoc()) {
        $product = array();
        $product["medicine"] = $row["medicine"];
        $product["dose"] = $row["dose"];
        $product["time_of_day"] = $row["time_of_day"];
        $product["reading_time"] = $row["reading_time"];
        array_push($response["Medicines"], $product);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No products found";
    echo json_encode($response);
}

?>
