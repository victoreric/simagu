<?php
include 'menuA.php';
include '../link.php'
?>

<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
  </ul>
</div>

<div class="container-fluid small">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Kegiatan-Kegiatan</h6>
    </div>
    <div class="card-body" style="color:black">
        <nav class="mb-2">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                
                <button class="nav-link active" id="nav-view-tab" data-toggle="tab" data-target="#nav-view" type="button" role="tab" aria-controls="nav-view" aria-selected="True">Lihat Data</button>

                <button class="nav-link" id="nav-input-tab" data-toggle="tab" data-target="#nav-input" type="button" role="tab" aria-controls="nav-input" aria-selected="False">Masukan Data</button>

                <!-- <button class="nav-link" id="nav-rekap-tab" data-toggle="tab" data-target="#nav-rekap" type="button" role="tab" aria-controls="nav-rekap" aria-selected="false">Rekap</button> -->
            </div>
        </nav>

        <div class="tab-content mt-4" id="nav-tabContent">
            <!-- viewdata -->
            <div class="tab-pane fade show active" id="nav-view" role="tabpanel" aria-labelledby="nav-view-tab">
                
            <table id='example1' class="table table-striped table-bordered table-hover table-responsive">
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

                    <td><a href='ke?id=<?php echo $hasil['id_kegiatan'] ?>' class='btn-sm btn-success fas fa-edit'> </a>
                        
                    <a href="k?id=<?php echo $hasil['id_kegiatan']; ?>" onclick="javascript:return confirm('Anda Yakin untuk menghapus data ini?')" class="btn-sm btn-danger fas fa-trash-alt mt-1"> </a>
                        
                    </td>
                    </tr>
            <?php } ?>
            </table>  
            </div>

            <!-- inputdata -->
            <div class="tab-pane fade" id="nav-input" role="tabpanel" aria-labelledby="nav-input-tab">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="id_jemaat" class="col-sm-2 col-form-label">Jemaat</label>
                    <div class="col-sm-10">
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
                    <label for="seksi" class="col-sm-2 col-form-label">Seksi</label>
                    <div class="col-sm-10">
                    <select name="seksi" id='seksi' class="form-control" required>
                        <option value="">--Pilih Seksi--</option>
                        <?php      
                            $queri="SELECT * FROM seksi ORDER BY kd_seksi";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kd_seksi']."'>".$res['nama_seksi']."</option>";   
                            }
                        ?>     
                    </select>
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="subseksi" class="col-sm-2 col-form-label">Sub Seksi</label>
                    <div class="col-sm-10">
                    <select name="subseksi" id='subseksi' class="form-control" required>
                        <option value="">--Pilih Sub Seksi--</option>
                        <?php      
                            $queri="SELECT *, seksi.kd_seksi, seksi.nama_seksi
                            FROM subseksi 
                            INNER JOIN seksi ON subseksi.kd_seksi = seksi.kd_seksi ORDER BY kd_subseksi";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                        ?>    
                            <option id='subseksi' class="<?php echo $res['kd_seksi'] ?>" value="<?php echo $res['kd_subseksi'] ?>">
                            
                            <?php echo $res['nama_subseksi']; ?>
                        </option>";
                        <?php } ?>     
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
                        <br>
                        <div class="form-group row">
                            <label for="ket_capaian_keg" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_keg" name="ket_capaian_keg" rows="3" required></textarea>
                            </div>
                        </div>
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
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_biaya" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_biaya" name="ket_capaian_biaya" rows="3" required></textarea>
                            </div>
                        </div>
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
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_sasaran" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_sasaran" name="ket_capaian_sasaran" rows="3" required></textarea>
                            </div>
                        </div>
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
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_waktu" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_waktu" name="ket_capaian_waktu" rows="3" required></textarea>
                            </div>
                        </div>
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
                   <br>
                        <div class="form-group row">
                            <label for="ket_capaian_tempat" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_tempat" name="ket_capaian_tempat" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>  
                <div class="panel-footer mt-5 text-center">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="k" class="btn btn-danger">Batal</a>
                 </div>
            </form>
            </div>

            <!-- <div class="tab-pane fade" id="nav-rekap" role="tabpanel" aria-labelledby="nav-rekap-tab">rekapitulasi</div> -->

        </div>
    </div>
</div>

</div>



<?php
// simpandata
if(isset($_POST['simpan'])){
    $kd_jemaat=$_POST['kd_jemaat']; 
    $seksi=$_POST['seksi']; 
    $subseksi=$_POST['subseksi'];
    $nomor_kegiatan=$_POST['nomor_kegiatan'];
    $periode=$_POST['periode']; 
    $kegiatan=$_POST['kegiatan'];
    $indikator=$_POST['indikator'];
    $capaian_keg=$_POST['capaian_keg'];
    $ket_capaian_keg=$_POST['ket_capaian_keg'];

    $capaian_biaya=$_POST['capaian_biaya'];
    $ket_capaian_biaya=$_POST['ket_capaian_biaya'];
    $capaian_sasaran=$_POST['capaian_sasaran'];
    $ket_capaian_sasaran=$_POST['ket_capaian_sasaran'];
    $capaian_waktu=$_POST['capaian_waktu'];
    $ket_capaian_waktu=$_POST['ket_capaian_waktu'];
    $capaian_tempat=$_POST['capaian_tempat'];
    $ket_capaian_tempat=$_POST['ket_capaian_tempat'];

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
    }elseif($nilai_capaian>=1){
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
    
    $query="INSERT INTO kegiatan (kd_jemaat, kd_seksi, kd_subseksi, nomor_kegiatan, periode, kegiatan, indikator, capaian_keg, ket_capaian_keg, capaian_biaya, ket_capaian_biaya, capaian_sasaran, ket_capaian_sasaran, capaian_waktu, ket_capaian_waktu, capaian_tempat, ket_capaian_tempat, nilai_capaian_keg, nilai_biaya, nilai_sasaran, nilai_waktu, nilai_tempat, nilai_capaian, nilai_kategori, nilai_capaian_subbidang, realisasi) VALUES ('$kd_jemaat','$seksi','$subseksi','$nomor_kegiatan','$periode','$kegiatan','$indikator','$capaian_keg','$ket_capaian_keg','$capaian_biaya','$ket_capaian_biaya','$capaian_sasaran','$ket_capaian_sasaran','$capaian_waktu','$ket_capaian_waktu','$capaian_tempat','$ket_capaian_tempat','$nilai_capaian_keg','$nilai_biaya','$nilai_sasaran','$nilai_waktu','$nilai_tempat','$nilai_capaian','$nilai_kategori','$nilai_capaian_subbidang','$realisasi')";
      
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Input Kegiatan berhasil disimpan.'); window.location='k'; </script>" ;
    }else{
        echo "terjadi kesalahan";
        echo "<script> alert ('Terjadi kesalahan penyimpanan data '); window.location='k'; </script>" ;
    }
}
// akhirProsesSimpanData

// deletedata
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $queri="DELETE FROM kegiatan WHERE id_kegiatan=$id ";
    $sql=mysqli_query($conn,$queri);

    if($sql){
        echo "<script>alert('Berhasil menghapus data');window.location='k'; </script>";
    }
}
?>

<script type="text/javascript">  
    $(function () {  
     $("#example1").dataTable();  
     $('#example2').dataTable({  
      "bPaginate": true,  
      "bLengthChange": false,  
      "bFilter": true,  
      "bSort": true,  
      "bInfo": true,  
      "bAutoWidth": false  
     });  
    });  
   </script> 

<!-- scriptForComboBoxBertingkat -->
<script src="../vendor/jquery/jquery-1.10.2.min.js"></script>
<script src="../vendor/jquery/jquery.chained.min.js"></script>
<script>
    $("#subseksi").chained("#seksi");
</script>

<?php
include '../footer.php';
?>