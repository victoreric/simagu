<?php

use Dompdf\FrameDecorator\Table;

include "../link.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik</title>
</head>
<body>

<?php
// $query = "SELECT DISTINCT kegiatan.kd_seksi, seksi.kd_seksi, seksi.nama_seksi, COUNT(kegiatan.kd_seksi) as jum
// FROM kegiatan
// INNER JOIN seksi ON seksi.kd_seksi=kegiatan.kd_seksi
// GROUP BY kegiatan.kd_seksi";
$query = "SELECT DISTINCT kegiatan.kd_seksi, seksi.kd_seksi, seksi.nama_seksi, COUNT(kegiatan.kd_seksi) as jum
FROM kegiatan
INNER JOIN seksi ON seksi.kd_seksi=kegiatan.kd_seksi
GROUP BY kegiatan.kd_seksi

";

$sql=mysqli_query($conn,$query);
while($hasil=mysqli_fetch_array($sql)){

    
    echo $hasil['nama_seksi']." | ".$hasil['kd_seksi'] ."<br>";

}
?>

</body>
</html>