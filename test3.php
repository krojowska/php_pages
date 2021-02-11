<?php
// test.php bez nazwy tablicy
$servername = "mysql.agh.edu.pl:3306";
$username = "rojowska";
$password = "pass";
$dbname = "rojowska";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn)
{
    $sql = "SELECT id, sensorsTemperature, chipId, reading_time FROM SensorData";
    $result = mysqli_query($conn, $sql);

    $response = array();
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($response, $row);
    }

    echo json_encode($response);
}
mysqli_close($conn);
?>
