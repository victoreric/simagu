<?php
// include 'menuA.php';
// include '../link.php';
?>
<div>
        <!-- <ul class='breadcrumb'>
        <li class='breadcrumb-item'><a href='index'><i class='fas fa-home'></i></a></li>
        <li class='breadcrumb-item'><a href='rss'>Rekapitulasi</a></li>
        <li class='breadcrumb-item'><a href='#'>Export to Excel</a></li>
        </ul>
</div> -->

<div class="container-fluid">
<?php 
    // fungsi header dengan mengirimkan raw data excel
        header('Content-type: application/vnd-ms-excel');      
    // membuat nama file ekspor "data-anggota.xlsl"
        header('Content-Disposition: attachment; filename=laporanSubSeksi.xls');    
    // data source
    include '../link.php'; 
    $kd_seksi=$_GET['kd_seksi'];
    $kd_subseksi=$_GET['kd_subseksi'];
    // echo $kd_seksi;
    // echo "<br>";
    // echo $kd_subseksi;
    ?>

   <table border='1'>
            <tr>
                <th colspan='12'>Capaian Realisasi Kegiatan</th>
            </tr>
            <tr>
            <?php
                $query1="SELECT * FROM seksi WHERE kd_seksi='$kd_seksi'";
                $sql1=mysqli_query($conn,$query1);
                $hasil1=mysqli_fetch_array($sql1);

                $query2="SELECT * FROM subseksi WHERE kd_subseksi='$kd_subseksi'";
                $sql2=mysqli_query($conn,$query2);
                $hasil2=mysqli_fetch_array($sql2);
            ?>
            <th colspan='12'>Seksi <?php echo $hasil1['nama_seksi']. " - " ?> Sub Seksi <?php echo $hasil2['nama_subseksi'] ?></th>
            </tr>
        <tr bgcolor="#e5e5e5">
        <th scope="col" rowspan='2'  class="align-middle" >No.</th>
        <th scope="col" rowspan='2'  class="align-middle">KEGIATAN</th>
        <th scope="col" rowspan='2'  class="align-middle">INDIKATOR</th>
        <th scope="col" colspan='5'  class="align-middle">CAPAIAN</th>
        <th scope="col" rowspan='2' class="align-middle">% Capaian</th>
        <th scope="col" rowspan='2' class="align-middle">Kategori</th>
        <th scope="col" rowspan='2' class="align-middle">Capaian Sub Seksi (%)</th>
        <th scope="col" rowspan='2' class="align-middle">Realisasi</th>
        </tr>
        <tr bgcolor="#e5e5e5">
        <th scope="col">Kegiatan</th>
        <th scope="col">Biaya</th>
        <th scope="col">Sasaran</th>
        <th scope="col">Waktu</th>
        <th scope="col">Tempat</th>
        </tr>
    </thead>

    <?php
    $no=1;
   
    // mendapatkan nama kegiatan setiap sub seksi
    $query="SELECT * FROM kegiatan WHERE kd_seksi='$kd_seksi' AND kd_subseksi='$kd_subseksi'";
    $sql = mysqli_query($conn,$query);
    while($hasil=mysqli_fetch_array($sql)){
    ?>

    <tr>
      <th><?php echo $no++; ?></th>
      <td><?php echo $hasil['kegiatan'] ?></td>
      <td><?php echo $hasil['indikator']  ?></td>
      <td><?php echo $hasil['capaian_keg']  ?></td>
      <td><?php echo $hasil['capaian_biaya']  ?></td>
      <td><?php echo $hasil['capaian_sasaran']  ?></td>
      <td><?php echo $hasil['capaian_waktu']  ?></td>
      <td><?php echo $hasil['capaian_tempat']  ?></td>
      <td><?php echo $hasil['nilai_capaian']  ?></td>
      <td><?php echo $hasil['nilai_kategori']; ?></td>
      <td><?php echo $hasil['nilai_capaian_subbidang']; ?></td>
      <td><?php echo $hasil['realisasi']; ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan='10'>Persentase Capaian Realisasi Sub Seksi (%)</td>
      <?php
        // mendapatkan jumlah kegiatan setiap subseksi
        $query2="SELECT count(*) as jum FROM kegiatan WHERE kd_seksi='$kd_seksi' AND kd_subseksi='$kd_subseksi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlah=$data2['jum'];
        // $totalKegiatan+=$jumlah;

        // mendapatkan jumlah nilai capaian subseksi
        $query4="SELECT SUM(nilai_capaian_subbidang) AS capaian FROM kegiatan WHERE kd_seksi='$kd_seksi' AND kd_subseksi='$kd_subseksi'";
        $sql4=mysqli_query($conn,$query4);
        $data4=mysqli_fetch_array($sql4);
        $jumlahCapaian=$data4['capaian'];

        // rumus Persentase Realisasi kegiatan(%) adalah (total jumlah capaian subseski/(jumlah kegiatan*2))*100
        // persentase realisasi
        if($jumlahCapaian!=0 AND $jumlah!=0){
          $cari=$jumlah*2;
          $persentaseReaKeg1=($jumlahCapaian/$cari)*100;
          $persentaseReaKeg=Round($persentaseReaKeg1,2);
        }else{
          $persentaseReaKeg='0';
        }
      ?>
      <td><?php echo $persentaseReaKeg ?></td>
      <td></td>
    </tr>
    </table>


</div>
