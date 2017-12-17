<html>
<head><title>Hamit Can Uzunay - Odev 2</title>
<style>
    /*-- Tablo etrafına çerçeve için alttaki css kodu */
    table, th, td {
        border: 2px solid #ffcb67;
    }
</style></head>
<body>
<?php
$username = "root"; //database kullanıcı adı
$password = "";     //database şifresi - bende şifre olmadığı için boş geçtim
$databasename = "odev2"; //bağlanmak istediğimiz database adı

/*
 * alttaki $connection nesnesi bizim bağlantı bilgilerini tutmakta
 * bağlanmak için mysqli_connect(host,username,password,databaseName);
 */
$connection = mysqli_connect("localhost",$username,$password,$databasename);

//herhangi bir bağlanma hatası oldu mu kontrol ediyoruz
if ($connection->connect_error)
    die("Connection failed: " . $conn->connect_error);

/*
 * $queryString değişkeni string olarak sorgu cümlemizi tutmakta bunu server'a string olarak göndeririz
 * o kendisi yorumlar yanlış ise bize hata dönderir
 */
$queryString = "SELECT * FROM odev2.sehir";

/*
 * $resultCityTable değişkeni kendisine gönderilen sorgu cümlesinin sonucu tutar
 * biz select ile veri çektiğimiz için içerisinde tablo verileri olacaktır
 */
$resultCityTable = $connection->query($queryString);

if ($resultCityTable->num_rows > 0) {
    echo "<table><th>Plaka</th><th>Sehir Adi</th><th>Tıklama</th>";
    while($row = $resultCityTable->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["ID"] ."</td>";
        echo "<td>". $row["SEHIR_AD"] ."</td>";
        echo "<td><a href='index.php?city_id=".$row["ID"]."'>Bana Tıkla</a> </td>"; //click yapılacak linkin uzantısına şehir plaka kodu ekledik
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