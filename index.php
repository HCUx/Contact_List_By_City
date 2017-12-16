<html>
<head><title>Hamit Can Uzunay - Odev 2</title>
<style>
    table, th, td {
        border: 2px solid #ffcb67;
    }
</style></head>
<body>
<?php
$username = "root";
$password = "";
$databasename = "odev2";

$connection = mysqli_connect("localhost",$username,$password,$databasename);

if ($connection->connect_error)
    die("Connection failed: " . $conn->connect_error);



$queryString = "SELECT * FROM odev2.sehir";
$resultCityTable = $connection->query($queryString);

if ($resultCityTable->num_rows > 0) {
    echo "<table><th>Plaka</th><th>Sehir Adi</th><th>Tıklama</th>";
    while($row = $resultCityTable->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["ID"] ."</td>";
        echo "<td>". $row["SEHIR_AD"] ."</td>";
        echo "<td><a href='index.php?city_id=".$row["ID"]."'>Bana Tıkla</a> </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
unset($resultCityTable);
if (isset($_GET["city_id"])){
    $city_id = $_GET["city_id"];
    unset($queryString);

    $queryString = "SELECT * FROM odev2.musteri WHERE SEHIR_ID = $city_id";

    $resultMusteriTable = $connection->query($queryString);

    if ($resultMusteriTable->num_rows > 0) {
        echo "<table><th>ID</th><th>Adi</th><th>Soyad</th><th>Sehir ID</th>";
        unset($row);
        while($row = $resultMusteriTable->fetch_assoc()) {
            echo "<tr>";
            echo "<td>". $row["ID"] ."</td>";
            echo "<td>". $row["AD"] ."</td>";
            echo "<td>". $row["SOYAD"] ."</td>";
            echo "<td>". $row["SEHIR_ID"] ."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

$connection->close();

?>
</body>
</html>