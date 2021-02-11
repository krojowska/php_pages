<!DOCTYPE html>
<html lang="en">
<head>
    <title>Medicines</title>
    <input type=button onClick="parent.location='http://www.student.agh.edu.pl/~rojowska'" value='Main Page'>
</head>
<body>
<form action="insert-medicines.php" method="post">
    <br/>
    Medicine: <input type="text" name="medicine">
    <br/><br/>
    Dose: <input type="text" name="dose">
    <br/><br/>
    Time of day: <input type="text" name="time_of_day">
    <br/><br/>
    <input type="submit" value="Save">
</form>

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

echo '<table cellspacing="5" cellpadding="5">
    <tr>
        <td>Medicine</td>
        <td>Dose</td>
        <td>Time of day</td>
        <td>Date</td>
    </tr>';

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_medicine = $row["medicine"];
        $row_dose = $row["dose"];
        $row_time_of_day = $row["time_of_day"];
        $row_reading_time = $row["reading_time"];


        echo '<tr>
    <td>' . $row_medicine . '</td>
    <td>' . $row_dose . '</td>
    <td>' . $row_time_of_day . '</td>
    <td>' . $row_reading_time. '</td>
</tr>';
    }
    $result->free();
}
?>

</body>
</html>


