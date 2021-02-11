<?php
$servername = "mysql.agh.edu.pl:3306";
$username = "rojowska";
$password = "pass";
$dbname = "rojowska";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, sensorsTemperature, chipId, reading_time FROM SensorData ORDER BY id DESC";

if ($result = $conn->query($sql)) {
    $response["SensorData"] = array();

    while ($row = $result->fetch_assoc()) {
        $product = array();
        $product["sensorsTemperature"] = $row["sensorsTemperature"];
        $product["reading_time"] = $row["reading_time"];
        $product["chipId"] = $row["chipId"];
        $product["id"] = $row["id"];
        array_push($response["SensorData"], $product);
    }
    $response["success"] = 1;

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No products found";
    echo json_encode($response);
}
//$conn = new mysqli($servername, $username, $password, $dbname);
//$sql="SELECT sensorsTemperature, chipId, reading_time FROM SensorData ORDER BY id DESC";
//
//$response = array();
//$posts = array();
//if ($result = $conn->query($sql)) {
//    while ($row = $result->fetch_assoc()) {
//        $sensorsTemperature = $row['sensorsTemperature'];
//        $reading_time = $row['reading_time'];
//
//        $posts[] = array('sensorsTemperature' => $sensorsTemperature, 'reading_time' => $reading_time);
//    }
//
//    $response['posts'] = $posts;
//
//    $fp = fopen('results.json', 'w');
//    fwrite($fp, json_encode($response));
//    fclose($fp);
//}
?>
