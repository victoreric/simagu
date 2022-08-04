<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Kegiatan
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "edit":
            edit($conn);
            break;
        case "delete":
            delete($conn);
            break;
        case "add":
            add($conn);
            break;
        default:
            view($conn);
        }
} else {
    view($conn);
}
?>

<?php
// fungsi view data
function view($conn){ ?>
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
  </ul>
</div>

<div class="container-fluid"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Kegiatan  Sub Seksi / Bagian 
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="k2?aksi=add" class="btn btn-success mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
    <thead class="thead-dark">
        <tr class="text-center">
        <th scope="col" class="align-middle">No.</th>
        <th scope="col" class="align-middle" >Jemaat</th>
        <th scope="col" class="align-middle">Seksi - Sub Seksi</th>
        <th scope="col" class="align-middle">Nomor Kegiatan</th>
        <th scope="col" class="align-middle">Periode</th>
        <th scope="col" class="align-middle">Kegiatan</th>
        <th scope="col" class="align-middle">Indikator Kegiatan</th>
        <th scope="col" class="align-middle">Capaian Kegiatan</th>
        <th scope="col" class="align-middle">Capaian Biaya</th>
        <th scope="col" class="align-middle">Capaian Sasaran</th>
        <th scope="col" class="align-middle">Capaian Waktu</th>
        <th scope="col" class="align-middle">Capaian Tempat</th>
        <th scope="col" class="align-middle">Persentase Capaian</th>
        <th scope="col" class="align-middle">Kategori Capaian</th>
        <th scope="col" class="align-middle">Capaian SubSeksi (%)</th>
        <th scope="col" class="align-middle">Realisasi</th>
        <th scope="col" class="align-middle">Aksi</th>
        </tr>
    </thead>
    <?php 
        $no=0;
        $query="SELECT *, jemaat.kd_jemaat, jemaat.nama_jemaat, seksi.kd_Seksi, seksi.nama_seksi, subseksi.kd_subseksi, subseksi.nama_subseksi
        FROM kegiatan 
        LEFT JOIN jemaat ON jemaat.kd_jemaat=kegiatan.kd_jemaat
        LEFT JOIN seksi ON seksi.kd_seksi=kegiatan.kd_seksi
        LEFT JOIN subseksi ON subseksi.kd_subseksi=kegiatan.kd_subseksi
        ORDER BY id_kegiatan DESC";
        $sql = mysqli_query($conn,$query);
        while($hasil=mysqli_fetch_array($sql)){
            $no++; 
    ?>
        <tr>
        <th scope="row"><?php echo $no; ?></th>
        <td><?php echo $hasil['nama_jemaat']; ?></td>
        <td><?php echo $hasil['nama_seksi']. " - ". $hasil['nama_subseksi'] ; ?></td>
        <td><?php echo $hasil['nomor_kegiatan']; ?></td>
        <td><?php echo $hasil['periode']; ?></td>
        <td><?php echo $hasil['kegiatan']; ?></td>
        <td><?php echo $hasil['indikator']; ?></td>
        <td><?php echo $hasil['capaian_keg']; ?></td>
        <td><?php echo $hasil['capaian_biaya']; ?></td>
        <td><?php echo $hasil['capaian_sasaran']; ?></td>
        <td><?php echo $hasil['capaian_waktu']; ?></td>
        <td><?php echo $hasil['capaian_tempat']; ?></td>
        <td><?php echo $hasil['nilai_capaian']; ?></td>
        <td><?php echo $hasil['nilai_kategori']; ?></td>
        <td><?php echo $hasil['nilai_capaian_subbidang']; ?></td>
        <td><?php echo $hasil['realisasi']; ?></td>

        <td><a href='ke?id=<?php echo $hasil['id_kegiatan'] ?>' class='btn-sm btn-warning fas fa-edit'> </a>
            
        <a href="k?id=<?php echo $hasil['id_kegiatan']; ?>" onclick="javascript:return confirm('Anda Yakin untuk menghapus data ini?')" class="btn-sm btn-danger fas fa-trash-alt mt-1"> </a>
            
        </td>
        </tr>		
    <?php } ?>
    </table>
  </div>
</div>
</div>
<?php } 
// endFungsiViewData


// hapus data
function delete($conn){
    if(isset($_GET['aksi']) && isset($_GET['id']) ){
        $id=$_GET['id'];
        $queri="DELETE FROM subseksi WHERE id_subseksi=$id ";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='k2'; </script>";
        }
    }
}
// endhapus data


// tambahdata
function add($conn){ 
?>
    <div>
        <ul class='breadcrumb'>
        <li class='breadcrumb-item'><a href='index'><i class='fas fa-home'></i></a></li>
        <li class='breadcrumb-item'><a href='k2'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='k2?aksi=add'>Tambah Master Sub Seksi</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h5 text-center"> Tambah Master Sub Seksi</div>
            <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="id_jemaat" class="col-sm-2 col-form-label">Jemaat</label>
                    <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="idjemaat" name="idjemaat"> -->
                    <select name="kd_jemaat" id='kd_jemaat' class="form-control" required>
                        <?php      
                            $queri="SELECT * FROM jemaat";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kd_jemaat'].  "' >".$res['nama_jemaat']. "</option>     ";}
                        ?>     
                    </select>
                    
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kd_seksi" class="col-sm-2 col-form-label">Seksi</label>
                    <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="idseksi" name="idseksi"> -->
                    <select name="kd_seksi" id='kd_seksi' class="form-control" required>
                        <option value="">--Pilih Seksi--</option>
                        <?php      
                            $queri="SELECT * FROM seksi";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kd_seksi']."'>".$res['nama_seksi']."</option>";}
                        ?>     
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kd_subseksi" class="col-sm-2 col-form-label">Sub Seksi</label>
                    <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" id="idsubseksi" name="idsubseksi"> -->
                    <select name="kd_subseksi" id='kd_subseksi' class="form-control" required>
                        <option value="">--Pilih Sub Seksi--</option>
                        <?php      
                            $queri="SELECT * FROM subseksi";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kd_subseksi']."'>".$res['nama_subseksi']."</option>";}
                        ?>     
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomor_kegiatan" class="col-sm-2 col-form-label">Nomor Kegiatan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomor_kegiatan" name="nomor_kegiatan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="periode" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                    <input type="year" class="form-control" id="periode" name="periode" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="kegiatan" name="kegiatan" rows="5" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="indikator" class="col-sm-2 col-form-label">Indikator</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="indikator" name="indikator" rows="5" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_keg" class="col-sm-2 col-form-label">Capaian Kegiatan</label>
                    <div class="col-sm-10">
                    <select name="capaian_keg" class="form-control" id='capaian_keg' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option> Sesuai Target</option>
                        <option> Lebih Target</option>
                        <option> Kurang Target</option>
                        <option> Nihil Target</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_biaya" class="col-sm-2 col-form-label">Capaian Biaya</label>
                    <div class="col-sm-10">
                    <select name="capaian_biaya" class="form-control" id='capaian_biaya' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option> Sesuai Target</option>
                        <option> Lebih Target</option>
                        <option> Kurang Target</option>
                        <option> Nihil Target</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_sasaran" class="col-sm-2 col-form-label">Capaian Sasaran</label>
                    <div class="col-sm-10">
                    <select name="capaian_sasaran" class="form-control" id='capaian_sasaran' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option> Sesuai Target</option>
                        <option> Lebih Target</option>
                        <option> Kurang Target</option>
                        <option> Nihil Target</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_waktu" class="col-sm-2 col-form-label">Capaian Waktu</label>
                    <div class="col-sm-10">
                    <select name="capaian_waktu" class="form-control" id='capaian_waktu' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option> Sesuai Target</option>
                        <option> Lebih Target</option>
                        <option> Kurang Target</option>
                        <option> Nihil Target</option>
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_tempat" class="col-sm-2 col-form-label">Capaian Tempat</label>
                    <div class="col-sm-10">
                    <select name="capaian_tempat" class="form-control" id='capaian_tempat' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option> Sesuai Target</option>
                        <option> Lebih Target</option>
                        <option> Kurang Target</option>
                        <option> Nihil Target</option>
                    </select>
                    </div>
                </div>

                <hr>  
                <div class="panel-footer mt-5 text-center">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="k2" class="btn btn-danger">Batal</a>
                 </div>
            </form>
            </div>
        </div>
    </div>   
<?php 
// proses simpan
if(isset($_POST['simpan'])){
    $kd_jemaat=$_POST['kd_jemaat']; 
    $kd_seksi=$_POST['kd_seksi']; 
    $kd_subseksi=$_POST['kd_subseksi'];
    $nomor_kegiatan=$_POST['nomor_kegiatan'];
    $periode=$_POST['periode']; 
    $kegiatan=$_POST['kegiatan'];
    $indikator=$_POST['indikator'];
    $capaian_keg=$_POST['capaian_keg'];
    $capaian_biaya=$_POST['capaian_biaya'];
    $capaian_sasaran=$_POST['capaian_sasaran'];
    $capaian_waktu=$_POST['capaian_waktu'];
    $capaian_tempat=$_POST['capaian_tempat'];

    if($capaian_keg=='Sesuai Target'){
        $nilai_capaian_keg='2';
    }elseif($capaian_keg=='Lebih Target'){
        $nilai_capaian_keg='3';
    }elseif($capaian_keg=='Kurang Target'){
        $nilai_capaian_keg='1';
    }else{
        $nilai_capaian_keg='0';
    }
    
    if($capaian_biaya=='Sesuai Target'){
        $nilai_biaya='2';
    }elseif($capaian_biaya=='Lebih Target'){
        $nilai_biaya='3';
    }elseif($capaian_biaya=='Kurang Target'){
        $nilai_biaya='1';
    }else{
        $nilai_biaya='0';
    }
    
    if($capaian_sasaran=='Sesuai Target'){
        $nilai_sasaran='2';
    }elseif($capaian_sasaran=='Lebih Target'){
        $nilai_sasaran='3';
    }elseif($capaian_sasaran=='Kurang Target'){
        $nilai_sasaran='1';
    }else{
        $nilai_sasaran='0';
    }

    if($capaian_waktu=='Sesuai Target'){
        $nilai_waktu='2';
    }elseif($capaian_waktu=='Lebih Target'){
        $nilai_waktu='3';
    }elseif($capaian_waktu=='Kurang Target'){
        $nilai_waktu='1';
    }else{
        $nilai_waktu='0';
    }

    if($capaian_tempat=='Sesuai Target'){
        $nilai_tempat='2';
    }elseif($capaian_tempat=='Lebih Target'){
        $nilai_tempat='3';
    }elseif($capaian_tempat=='Kurang Target'){
        $nilai_tempat='1';
    }else{
        $nilai_tempat='0';
    }
    
    $nilai_capaian=($nilai_capaian_keg+$nilai_biaya+$nilai_sasaran+$nilai_waktu+$nilai_tempat)/10*100;
    
    if($nilai_capaian>=101){
        $nilai_kategori='Lebih Target';
    }elseif($nilai_capaian==100){
        $nilai_kategori='Sesuai Target';
    }elseif($nilai_capaian==99){
        $nilai_kategori='Kurang Target';
    }else{
        $nilai_kategori='Nihil Target';
    }

    if($nilai_kategori=='Sesuai Target'){
        $nilai_capaian_subbidang='2';
    }elseif($nilai_kategori=='Lebih Target'){
        $nilai_capaian_subbidang='3';
    }elseif($nilai_kategori=='Kurang Target'){
        $nilai_capaian_subbidang='1';
    }else{
        $nilai_capaian_subbidang='0';
    }

    if($nilai_kategori=='Sesuai Target'){
        $realisasi='Realisasi';
    }elseif($nilai_kategori=='Lebih Target'){
        $realisasi='Realisasi';
    }elseif($nilai_kategori=='Kurang Target'){
        $realisasi='Realisasi';
    }else{
        $realisasi='Tidak Realisasi';
    }
    $query="INSERT INTO kegiatan(kd_jemaat, kd_seksi, kd_subseksi, nomor_kegiatan, periode, kegiatan, indikator, capaian_keg, capaian_biaya, capaian_sasaran, capaian_waktu, capaian_tempat, nilai_capaian_keg, nilai_biaya, nilai_sasaran, nilai_waktu, nilai_tempat, nilai_capaian, nilai_kategori, nilai_capaian_subbidang, realisasi) VALUES ('$kd_jemaat','$kd_seksi','$kd_subseksi','$nomor_kegiatan','$periode','$kegiatan','$indikator','$capaian_keg','$capaian_biaya','$capaian_sasaran','$capaian_waktu','$capaian_tempat','$nilai_capaian_keg','$nilai_biaya','$nilai_sasaran','$nilai_waktu','$nilai_tempat','$nilai_capaian','$nilai_kategori','$nilai_capaian_subbidang','$realisasi')";
      
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Input Kegiatan berhasil disimpan.'); window.location='k'; </script>" ;
    }else{
        echo "terjadi kesalahan";
        echo "<script> alert ('Terjadi kesalahan penyimpanan data '); window.location='k'; </script>" ;
    }
}
}
// endtambahdata


// fungsiEditData
function edit($conn){  ?>
	<div>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
		<li class="breadcrumb-item"><a href="k2?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update Master Sub Seksi / Bagian</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT *, jemaat.kd_jemaat, jemaat.nama_jemaat
FROM subseksi 
INNER JOIN jemaat ON jemaat.kd_jemaat=subseksi.kd_jemaat
where id_subseksi=$id";

$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Master Sub Seksi / Bagian</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
 		 <label for="kd_jemaat" class="">Nama Jemaat</label>
        
         <select name="kd_jemaat" id='kd_jemaat' class="form-control">
         <option value=''> -- Pilih Jemaat --  </option>
            <?php      
                $queri="SELECT * FROM jemaat";
                $sql=mysqli_query($conn,$queri);
                while($res=mysqli_fetch_array($sql)){
                    
                    if($hasil['kd_jemaat']==$res['kd_jemaat']){
                        echo " <option value='".$res['kd_jemaat']. "' selected>".$res['nama_jemaat']. "</option> "; 
                    }  else {
                        echo " <option value='".$res['kd_jemaat'].  "' >".$res['nama_jemaat']. "</option> ";
                    }                 
                }
            ?>     
        </select>

         <br> 
         <label for="id_seksi" class="">Nama Seksi</label>
         <select name="kd_seksi" id='kd_seksi' class="form-control">
         <option value=''> -- Pilih Seksi --  </option>
            <?php      
                $queri="SELECT * FROM seksi";
                $sql=mysqli_query($conn,$queri);
                while($res=mysqli_fetch_array($sql)){
                    
                    if($hasil['kd_seksi']==$res['kd_seksi']){
                        echo " <option value='".$res['kd_seksi']. "' selected>".$res['nama_seksi']. "</option> "; 
                    }  else {
                        echo " <option value='".$res['kd_seksi'].  "' >".$res['nama_seksi']. "</option> ";
                    }                 
                }
            ?>     
        </select>
         <br>  
         <label for="kd_subseksi" class="">Kode Sub Seksi:</label>
         <input name="kd_subseksi" type="text" class="form-control" id="kd_subseksi" placeholder="Kode Sub Seksi / Bagian" value="<?php echo $hasil['kd_subseksi']; ?>">
         <br>

  		<label for="nama_subseksi" class="">Nama Sub Seksi:</label>
         <input name="nama_subseksi" type="text" class="form-control" id="nama_subseksi" placeholder="Nama Sub Seksi / Bagian" value="<?php echo $hasil['nama_subseksi']; ?>">
         <br>
       
         <label for='ketua'>Nama Ketua</label>
         <input name="ketua" type="text" class="form-control" id="ketua" placeholder="Ketua" value="<?php echo $hasil['ketua_subseksi']; ?>">
         <br>

         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="k2" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $kd_jemaat = $_POST['kd_jemaat'];
    $kd_seksi = $_POST['kd_seksi'];
    $kd_subseksi = $_POST['kd_subseksi'];
    $nama_subseksi = $_POST['nama_subseksi'];
    $ketua=$_POST['ketua'];
   
   $query = "UPDATE subseksi set kd_jemaat='$kd_jemaat', kd_seksi='$kd_seksi', kd_subseksi='$kd_subseksi', nama_subseksi='$nama_subseksi', ketua_subseksi='$ketua' WHERE id_subseksi=$id";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master Sub Seksi / Bagian berhasil diubah');window.location='k2';</script>"; 
             }
      else {
            echo "gagal";
            }           
}
}?>
<!-- endFungsiEditData -->

<script type="text/javascript">  
    $(function () {  
     $("#example1").dataTable();  
     $('#example2').dataTable({  
      "bPaginate": true,  
      "bLengthChange": false,  
      "bFilter": false,  
      "bSort": true,  
      "bInfo": true,  
      "bAutoWidth": false  
     });  
    });  
   </script> 



<?php 
include '../footer.php';
?>