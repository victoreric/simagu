<?php
include 'menuA.php';
include '../link.php';
?>

<div>
        <ul class='breadcrumb'>
        <li class='breadcrumb-item'><a href='index'><i class='fas fa-home'></i></a></li>
        <li class='breadcrumb-item'><a href='#'>Rekapitulasi</a></li>
        <li class='breadcrumb-item'><a href='#'>Capaian Realisasi Seksi</a></li>
        </ul>
    </div>

<div class="container-fluid">

    <h3 class='text-center'>Capaian Realisasi Seksi</h3>

    <form action="" method="POST">
    <label for="kd_seksi">Pilih Seksi :</label>
    <select class="form-control" name="kd_seksi" id="kd_seksi" required>
    <option value="">--Pilih Seksi--</option>
        <?php
            $query="SELECT * FROM seksi ORDER BY kd_seksi";
            $sql=mysqli_query($conn,$query);
            while($data=mysqli_fetch_array($sql)){
        ?>
    <option value="<?php echo $data['kd_seksi'] ?>"><?php echo $data['nama_seksi'] ?></option>
    <?php } ?>
    </select>

    <button type="submit" class="btn btn-primary mt-2 mb-5" name='pilih'>PILIH</button>
    </form>

<!-- process -->
<?php 
if(isset($_POST['pilih'])){
    $kd_seksi=$_POST['kd_seksi']; 
    
    $query="SELECT * FROM seksi WHERE kd_seksi='$kd_seksi'";
    $sql=mysqli_query($conn,$query);
    $hasil=mysqli_fetch_array($sql);
?>

<div class="card border-primary mb-3">
  <div class="card-header bg-primary text-white text-center">CAPAIAN REALISASI KEGIATAN <?php echo $hasil['nama_seksi'] ?>
  </div>

  <div class="card-body text-primary table-responsive">
    <table class="table table-striped table-bordered table-hover table-responsive-justify ">
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
    $no=1;
    $totalKegiatan=0;
    $totalKegiatanRea=0;
    $totalKegiatanTidakRea=0;
    $totalPersenRea=0;
    $totalPersenTidakRea=0;
    $totalJumlahCapaian=0;

    // mendapatkan nama subseksi
    $query="SELECT * FROM subseksi WHERE kd_seksi='$kd_seksi'";
    $sql=mysqli_query($conn,$query);
    while($hasil=mysqli_fetch_array($sql)){
    $kdSubSeksi=$hasil['kd_subseksi'];

    ?>
    <tbody class="text-center">
    <tr>
        <th scope="row"><?php echo $no++; ?></th>
        <td class="text-justify"><?php echo $hasil['nama_subseksi'];?></td>

        <?php
        // mendaptkan jumlah kegiatan setiap subseksi
        $query2="SELECT count(*) as jum FROM kegiatan WHERE kd_subseksi='$kdSubSeksi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlah=$data2['jum'];
        $totalKegiatan+=$jumlah;

        // mendapatkan jumlah kegiatan terealisasi dari masing-masing sub seksi
        $query2="SELECT count(*) as jumRea FROM kegiatan WHERE kd_subseksi='$kdSubSeksi' AND realisasi='Realisasi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlahRealisasi=$data2['jumRea'];
        $totalKegiatanRea+=$jumlahRealisasi;

        // mendapatkan jumlah kegiatan TIDAK terealisasi dari masing-masing sub seksi
        $query2="SELECT count(*) as jumTidakRea FROM kegiatan WHERE kd_subseksi='$kdSubSeksi' AND realisasi='Tidak Realisasi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlahTidakRealisasi=$data2['jumTidakRea'];
        $totalKegiatanTidakRea+=$jumlahTidakRealisasi;

        // mendapatkan jumlah nilai capaian subseksi
        $query4="SELECT SUM(nilai_capaian_subbidang) AS capaian FROM kegiatan WHERE kd_subseksi='$kdSubSeksi'";
        $sql4=mysqli_query($conn,$query4);
        $data4=mysqli_fetch_array($sql4);
        $jumlahCapaian=$data4['capaian'];
        $totalJumlahCapaian+=$jumlahCapaian;
        

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

        // rumus Total persentase realisasi kegiatan
        // totalPersentaseRealisasi=((totalJumlahCapaianSubSeksi/totalJumlahKegiatanSubSeksi)/2)*100
        if($totalJumlahCapaian!=0 AND $totalKegiatan!=0){
          $totalPersentaseRealisasi=round((($totalJumlahCapaian/$totalKegiatan)/2)*100,2);
        }else{
          $totalPersentaseRealisasi='0';
        }

        // rumus Total persentase TIDAK realisasi kegiatan
        $totalPersentaseTidakRealisasi=100-$totalPersentaseRealisasi;

        ?>
      <td><?php echo $jumlah ?></td>
      <td><?php echo $jumlahRealisasi ?></td>
      <td><?php echo $persentaseReaKeg?></td>
      <td><?php echo $jumlahTidakRealisasi ?></td></td>
      <td><?php echo $persentaseTidakReaKeg ?></td></td>
    </tr>
    <?php 
    
  } ?>
    <tr class="bg-secondary">
      <td colspan="2" class='text-center'>Jumlah</td>
      <td><?php echo $totalKegiatan ?></td>
      <td><?php echo $totalKegiatanRea ?></td>
      <td><?php echo $totalPersentaseRealisasi ?></td>
      <td><?php echo $totalKegiatanTidakRea ?></td>
      <td><?php echo $totalPersentaseTidakRealisasi ?></td>
    </tr>
    </tbody>
    </table>
  </div>
</div>

<?php } ?>
</div>

<?php
include '../footer.php';
?>