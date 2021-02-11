<?php
$servername = "mysql.agh.edu.pl:3306";
$username = "rojowska";
$password = "pass";
$dbname = "rojowska";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $sensorsTemperature  = $chipId = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);

    if($api_key == $api_key_value) {
        $sensorsTemperature = test_input($_POST["sensorsTemperature"]);
        $chipId = test_input($_POST["chipId"]);

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO SensorData (sensorsTemperature, chipId)
        VALUES ('" . $sensorsTemperature . "', '" . $chipId . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
