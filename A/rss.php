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
  <!-- <h3 class='text-center'>Capaian Realisasi Sub Seksi</h3> -->
  <form action="" method="POST">
      <label">Pilih Seksi : </label>
      <select class="form-control"  id="seksi" name="seksi" required>
          <option value=""> --- Silahkan Pilih Seksi ---</option>
              <?php
              $query = mysqli_query($conn, "SELECT DISTINCT kegiatan.kd_seksi, seksi.kd_seksi, seksi.nama_seksi
              FROM kegiatan
              INNER JOIN seksi ON seksi.kd_seksi=kegiatan.kd_seksi");
              
              while ($row = mysqli_fetch_array($query)) {
              ?>
          <option value="<?php echo $row['kd_seksi']; ?>"> <?php echo $row['nama_seksi']; ?> </option>
          <?php } ?>
      </select>

      <label for="subseksi" class="mt-3">Pilih Sub Seksi :</label>
      <select class="form-control" id="subseksi" name="subseksi" required/>
          <option value="">--- Silahkan Pilih Sub Seksi ---</option>
          <?php
          $query = mysqli_query($conn, "SELECT *, seksi.kd_seksi, seksi.nama_seksi
          FROM subseksi 
          INNER JOIN seksi ON subseksi.kd_seksi = seksi.kd_seksi ORDER BY kd_subseksi");
          while ($row = mysqli_fetch_array($query)) {
          ?>
              <option id="subseksi" class="<?php echo $row['kd_seksi']; ?>" value="<?php echo $row['kd_subseksi']; ?>">
                  <?php echo $row['nama_subseksi']; ?>
              </option>
      <?php } ?>
      </select>

      <button type="submit" class="btn btn-primary mt-2 mb-5" name='pilih'>PILIH</button>

      </form>
    <!-- cek -->
   



      <!-- endCek  -->

<?php 
// TampilkanProcess
if(isset($_POST['pilih'])){
    $kd_seksi=$_POST['seksi'];
    $query1="SELECT * FROM seksi WHERE kd_seksi='$kd_seksi'";
    $sql1=mysqli_query($conn,$query1);
    $hasil1=mysqli_fetch_array($sql1);

  
    $kd_subseksi=$_POST['subseksi']; 
    $query="SELECT * FROM subseksi WHERE kd_subseksi='$kd_subseksi'";
    $sql=mysqli_query($conn,$query);
    $hasil=mysqli_fetch_array($sql);

   
    // cek error
    $queryError="SELECT kd_subseksi FROM kegiatan WHERE kd_subseksi='$kd_subseksi'";
    $sqlError=mysqli_query($conn,$queryError);
    $cekError=mysqli_num_rows($sqlError);
    if($cekError==0){
      echo "Belum ada data";
    } else{
?>

<div class="card border-primary mb-3">
  <div class="card-header bg-primary text-white text-center">
    <h5>Capaian Realisasi Kegiatan  </h5>
    <span> Seksi <?php echo $hasil1['nama_seksi']. " - " ?> </span>
    <span> Sub Seksi <?php echo $hasil['nama_subseksi'] ?> </span>
  </div>

  <div class="card-body text-primary table-responsive">

  <a href="dataExcel?kd_seksi=<?php echo $kd_seksi; ?>&kd_subseksi=<?php echo $kd_subseksi;?>" class="btn btn-info mb-1" role="button">Export to Excel</a>

    <table class="table table-striped table-bordered table-hover table-responsive-justify ">
    <thead class="thead-dark text-center">
        <tr>
        <th scope="col" rowspan='2'  class="align-middle" >No.</th>
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
    $query="SELECT * FROM kegiatan WHERE kd_seksi='$kd_seksi' AND kd_subseksi='$kd_subseksi'";
    $sql = mysqli_query($conn,$query);
    while($hasil=mysqli_fetch_array($sql)){
    ?>

    <tr class="text-center">
      <th scope="row"><?php echo $no++; ?></th>
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
    <tr class="text-center bg-secondary">
      <td colspan="10" class='text-center'>Persentase Capaian Realisasi Sub Seksi (%)</td>
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
</div>

<?php } }
?>

</div>

<!-- scriptForComboBoxBertingkat -->
<script src="../vendor/jquery/jquery-1.10.2.min.js"></script>
<script src="../vendor/jquery/jquery.chained.min.js"></script>
<script>
    $("#subseksi").chained("#seksi");
</script>
<?php
include '../footer.php';
?>