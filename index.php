<!DOCTYPE html>
<html>
<head>
    <input type=button onClick="parent.location='http://www.student.agh.edu.pl/~rojowska/medicines.php'" value='Medicine and dosage'>
</head>
<body>
<?php
$servername = "mysql.agh.edu.pl:3306";
$username = "rojowska";
$password = "RJvmGMVCBEJboy0n";
$dbname = "rojowska";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sensorsTemperature, chipId, reading_time, UNIX_TIMESTAMP(reading_time) AS datetime  FROM SensorData ORDER BY id DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>Temperature</td>    
        <td>Date and time</td>    
        <td>Device ID</td> 
      </tr>';

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_sensor = $row["sensorsTemperature"];
        $row_reading_time = $row["reading_time"];
        $row_chip = $row["chipId"];

        echo '<tr> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_reading_time . '</td> 
                <td>' . $row_chip . '</td> 
              </tr>';
    }
    $result->free();
}

$result = mysqli_query($conn, $sql);
$rows = array();
$table = array();

$table['cols'] = array(
    array(
        'label' => 'Date Time',
        'type' => 'datetime'
    ),
    array(
        'label' => 'Temperature (°C)',
        'type' => 'number'
    )
);
while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $datetime = explode(".", $row["datetime"]);
    $sub_array[] =  array(
        "v" => 'Date(' . $datetime[0] . '000)'
    );
    $sub_array[] =  array(
        "v" => $row["sensorsTemperature"]
    );
    $sub_array[] =  array(
        "v" => $row["chipId"]
    );
    $rows[] =  array(
        "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);

$conn->close();
?>
</table>
</body>
</html>


<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart()
        {
            var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

            var options = {
                title:'Temperature vs Time',
                legend:{position:'bottom'},
                chartArea:{width:'95%', height:'65%'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

            chart.draw(data, options);
        }
    </script>
    <style>
        .page-wrapper
        {
            width:1000px;
            margin:0 auto;
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <br />
    <div id="line_chart" style="width: 100%; height: 500px"></div>
</div>
</body>
</html>