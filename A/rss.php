<?php
include 'menuA.php';
include '../link.php';
?>

<div>
        <ul class='breadcrumb'>
        <li class='breadcrumb-item'><a href='index'><i class='fas fa-home'></i></a></li>
        <li class='breadcrumb-item'><a href='#'>Rekapitulasi</a></li>
        <li class='breadcrumb-item'><a href='#'>Capaian Realisasi Sub Seksi</a></li>
        </ul>
    </div>

<div class="container-fluid">

    <h3 class='text-center'>Capaian Realisasi Sub Seksi</h3>

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

    <label for="kd_seksi" class="mt-4">Pilih Sub Seksi :</label>
    <select class="form-control" name="kd_subseksi" id="kd_subseksi" required>
    <option value="">--Pilih Sub Seksi--</option>
        <?php
            $query="SELECT * FROM subseksi ORDER BY kd_subseksi";
            $sql=mysqli_query($conn,$query);
            while($data=mysqli_fetch_array($sql)){
        ?>
    <option value="<?php echo $data['kd_subseksi'] ?>"><?php echo $data['nama_subseksi'] ?></option>
    <?php } ?>
    </select>

    <button type="submit" class="btn btn-primary mt-2 mb-5" name='pilih'>PILIH</button>
    </form>

<!-- process -->
<?php 
if(isset($_POST['pilih'])){
    $kd_seksi=$_POST['kd_seksi'];
    $query1="SELECT * FROM seksi WHERE kd_seksi='$kd_seksi'";
    $sql1=mysqli_query($conn,$query1);
    $hasil1=mysqli_fetch_array($sql1);

    $kd_subseksi=$_POST['kd_subseksi']; 
    $query="SELECT * FROM subseksi WHERE kd_subseksi='$kd_subseksi'";
    $sql=mysqli_query($conn,$query);
    $hasil=mysqli_fetch_array($sql);
?>

<div class="card border-primary mb-3">
  <div class="card-header bg-primary text-white text-center">
    <h5>Capaian Realisasi Kegiatan  </h5>
    <span> Seksi <?php echo $hasil1['nama_seksi']. " - " ?> </span>
    <span> Sub Seksi <?php echo $hasil['nama_subseksi'] ?> </span>
  </div>

  <div class="card-body text-primary table-responsive">
    <table class="table table-striped table-bordered table-hover table-responsive-justify ">
    <thead class="thead-dark text-center">
        <tr>
        <th scope="col" rowspan='2'  class="align-middle" >No.</th>
        <!-- <th scope="col" rowspan='2'  class="align-middle">SUBSEKSI</th> -->
        <th scope="col" rowspan='2'  class="align-middle">KEGIATAN</th>
        <th scope="col" rowspan='2'  class="align-middle">INDIKATOR</th>

        <th scope="col" colspan='5'  class="align-middle">CAPAIAN</th>
        <th scope="col" rowspan='2' class="align-middle">% Capaian</th>
        <th scope="col" rowspan='2' class="align-middle">Kategori</th>
        <th scope="col" rowspan='2' class="align-middle">Capaian Sub Seksi (%)</th>
        <th scope="col" rowspan='2' class="align-middle">Realisasi</th>
        </tr>
        <tr>
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
    $query="SELECT * FROM kegiatan WHERE kd_subseksi='$kd_subseksi'";
    $sql = mysqli_query($conn,$query);
    while($hasil=mysqli_fetch_array($sql)){
    ?>

    <tr class="text-center">
        <th scope="row"><?php echo $no++; ?></th>
        <!-- <td class="text-justify"><?php echo $hasil['nama_subseksi'];?></td> -->
        <td class="text-justify"><?php echo $hasil['kegiatan'] ?></td>
        
      <td class="text-justify"><?php echo $hasil['indikator']  ?></td>
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
    <tr class="text-center">
      <td colspan="10" class='text-center'>Jumlah Capaian Realisasi Sub Seksi</td>
      <?php
        // mendaptkan jumlah kegiatan setiap subseksi
        $query2="SELECT count(*) as jum FROM kegiatan WHERE kd_subseksi='$kd_subseksi'";
        $sql2=mysqli_query($conn,$query2);
        $data2=mysqli_fetch_array($sql2);
        $jumlah=$data2['jum'];
        // $totalKegiatan+=$jumlah;

        // mendapatkan jumlah nilai capaian subseksi
        $query4="SELECT SUM(nilai_capaian_subbidang) AS capaian FROM kegiatan WHERE kd_subseksi='$kd_subseksi'";
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
</div>


<?php }
?>

</div>

<?php
include '../footer.php';
?>