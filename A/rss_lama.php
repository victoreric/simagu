<?php 
include 'menuA.php';
include '../link.php';
?>
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Rekapitulasi</a></li>
    <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
  </ul>
</div>

<div class="container-fluid">


rekap sub seksi 
<table class="table table-striped table-bordered table-hover table-responsive ">
  <thead class="thead-dark text-center">
    <tr>
      <th scope="col" rowspan='2'  class="align-middle" >No.</th>
      <th scope="col" rowspan='2'  class="align-middle">SEKSI / SUBSEKSI</th>
      <th scope="col" rowspan='2'  class="align-middle">KEGIATAN</th>
      <th scope="col" colspan='2'>REALISASI</th>
      <th scope="col" colspan='2'>TIDAK REALISASI</th>
    </tr>
    <tr>
      <th scope="col">Kegiatan</th>
      <th scope="col">%</th>
      <th scope="col">Kegiatan</th>
      <th scope="col">%</th>
    </tr>
  </thead>
  <?php
  // inisialisasi nilai awal untuk total kegiatan sub seksi
  $no=1;
  $totalKegiatan=0;
  $totalKegiatanRea=0;
  $totalKegiatanTidakRea=0;
  $totalPersenRea=0;
  $totalPersenTidakRea=0;

  // mendapatkan nama sub seksi
  $query="SELECT * FROM subseksi";
  $sql=mysqli_query($conn,$query);
  while($hasil=mysqli_fetch_array($sql)){
  $kdSubSeksi=$hasil['kd_subseksi'];

  ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $no++; ?></th>
      <td><?php echo $hasil['nama_subseksi'];?></td>

      <?php
        // mendaptkan jumlah kegiatan setiap sub seksi
        $query2="SELECT count(*) as jum FROM kegiatan WHERE kd_subseksi=$kdSubSeksi";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlah=$data2['jum'];
        $totalKegiatan+=$jumlah;

        // mendapatkan jumlah kegiatan terealisasi dari masing-masing sub seksi
        $query2="SELECT count(*) as jumRea FROM kegiatan WHERE kd_subseksi=$kdSubSeksi AND realisasi='Realisasi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlahRealisasi=$data2['jumRea'];
        $totalKegiatanRea+=$jumlahRealisasi;

        // mendapatkan jumlah kegiatan TIDAK terealisasi dari masing-masing sub seksi
        $query2="SELECT count(*) as jumTidakRea FROM kegiatan WHERE kd_subseksi=$kdSubSeksi AND realisasi='Tidak Realisasi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlahTidakRealisasi=$data2['jumTidakRea'];
        $totalKegiatanTidakRea+=$jumlahTidakRealisasi;

        
        // mendapatkan jumlah nilai capaian subseksi
        $query4="SELECT SUM(nilai_capaian_subbidang) AS capaian FROM kegiatan WHERE kd_subseksi=$kdSubSeksi";
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

        // persentase TIDAK realisasi
        if($jumlahCapaian!=0 AND $jumlah!=0 AND $persentaseReaKeg!=0 ){
          $persentaseTidakReaKeg=100-$persentaseReaKeg;
      }else{
        $persentaseTidakReaKeg='0';
      }
        
      ?>
      <td><?php echo $jumlah ?></td>
      <td><?php echo $jumlahRealisasi ?></td>
      <td><?php echo $persentaseReaKeg?></td>
      <td><?php echo $jumlahTidakRealisasi ?></td></td>
      <td><?php echo $persentaseTidakReaKeg ?></td></td>
     
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" class='text-center'>Jumlah</td>
      <td><?php echo $totalKegiatan ?></td>
      <td><?php echo $totalKegiatanRea ?></td>
      <td><?php echo 11 ?></td>
      <td><?php echo $totalKegiatanTidakRea ?></td>
      <td><?php echo 11 ?></td>

    </tr>
  </tbody>
</table>

</div>

<?php
include '../footer.php';
?>
