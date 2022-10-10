<?php
include 'menuA.php';
include '../link.php';
?>

<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="k">Kegiatan</a></li>
    <li class="breadcrumb-item"><a href="#">Edit Kegiatan</a></li>
  </ul>
</div>

<div class="container">
    <div class="card">
    <div class="card-header bg-primary text-center text-white h4">
        Edit Kegiatan
    </div>

    <?php	
        $id=$_GET['id'];
        $query="SELECT * FROM kegiatan where id_kegiatan=$id";
        $sql=mysqli_query($conn,$query);
        $hasil=mysqli_fetch_array($sql);
    ?>
    <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="kd_jemaat" class="col-sm-2 col-form-label">Jemaat</label>
                    <div class="col-sm-10">
                    
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
                    </div>
                </div>
                <div class="form-group row">
                    <label for="seksi" class="col-sm-2 col-form-label">Seksi</label>
                    <div class="col-sm-10">

                     <select name="seksi" id='seksi' class="form-control">
                    <option value=''> -- Pilih Seksi --  </option>
                        <?php      
                            $queri="SELECT * FROM seksi ORDER BY kd_seksi";
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


                    </div>
                </div>
                <div class="form-group row">
                    <label for="subseksi" class="col-sm-2 col-form-label">Sub Seksi</label>
                    <div class="col-sm-10">

                    <select name="subseksi" id='subseksi' class="form-control">
                    <option value=''> -- Pilih Sub Seksi --  </option>
                        <?php      
                            $queri="SELECT *, seksi.kd_seksi, seksi.nama_seksi
                            FROM subseksi 
                            INNER JOIN seksi ON subseksi.kd_seksi = seksi.kd_seksi ORDER BY kd_subseksi";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                                
                                if($hasil['kd_subseksi']==$res['kd_subseksi']){
                                    echo " <option id='subseksi' class='".$res['kd_seksi'] ."' value='".$res['kd_subseksi']. "' selected>".$res['nama_subseksi']. "</option> "; 
                                }  else {
                                    echo " <option id='subseksi' class='".$res['kd_seksi'] ."'  value='".$res['kd_subseksi']."'>".$res['nama_subseksi']. "</option> ";
                                }                 
                            }
                        ?>     
                    </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomor_kegiatan" class="col-sm-2 col-form-label">Nomor Kegiatan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomor_kegiatan" name="nomor_kegiatan" value="<?php echo $hasil['nomor_kegiatan']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="periode" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="periode" name="periode" value="<?php echo $hasil['periode']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="kegiatan" name="kegiatan" rows="5" required> <?php echo $hasil['kegiatan']; ?> </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="indikator" class="col-sm-2 col-form-label">Indikator</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="indikator" name="indikator" rows="5" required> <?php echo $hasil['indikator']; ?> </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_keg" class="col-sm-2 col-form-label">Capaian Kegiatan</label>
                    <div class="col-sm-10">
                    <select name="capaian_keg" class="form-control" id='capaian_keg' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option value="Sesuai Target" <?php if($hasil['capaian_keg']=='Sesuai Target'){echo 'selected'; } ?> > Sesuai Target</option>
                        <option value="Lebih Target" <?php if($hasil['capaian_keg']=='Lebih Target'){echo 'selected'; } ?>> Lebih Target</option>
                        <option value="Kurang Target" <?php if($hasil['capaian_keg']=='Kurang Target'){echo 'selected'; } ?>> Kurang Target</option>
                        <option value="Nihil Target" <?php if($hasil['capaian_keg']=='Nihil Target'){echo 'selected'; } ?>> Nihil Target</option>
                    </select>
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_keg" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_keg" name="ket_capaian_keg" rows="3" required><?php echo $hasil['ket_capaian_keg']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_biaya" class="col-sm-2 col-form-label">Capaian Biaya</label>
                    <div class="col-sm-10">
                    <select name="capaian_biaya" class="form-control" id='capaian_biaya' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option value="Sesuai Target" <?php if($hasil['capaian_biaya']=='Sesuai Target'){echo 'selected'; } ?> > Sesuai Target</option>
                        <option value="Lebih Target" <?php if($hasil['capaian_biaya']=='Lebih Target'){echo 'selected'; } ?>> Lebih Target</option>
                        <option value="Kurang Target" <?php if($hasil['capaian_biaya']=='Kurang Target'){echo 'selected'; } ?>> Kurang Target</option>
                        <option value="Nihil Target" <?php if($hasil['capaian_biaya']=='Nihil Target'){echo 'selected'; } ?>> Nihil Target</option>
                    </select>
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_biaya" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_biaya" name="ket_capaian_biaya" rows="3" required><?php echo $hasil['ket_capaian_biaya']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_sasaran" class="col-sm-2 col-form-label">Capaian Sasaran</label>
                    <div class="col-sm-10">
                    <select name="capaian_sasaran" class="form-control" id='capaian_sasaran' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option value="Sesuai Target" <?php if($hasil['capaian_sasaran']=='Sesuai Target'){echo 'selected'; } ?> > Sesuai Target</option>
                        <option value="Lebih Target" <?php if($hasil['capaian_sasaran']=='Lebih Target'){echo 'selected'; } ?>> Lebih Target</option>
                        <option value="Kurang Target" <?php if($hasil['capaian_sasaran']=='Kurang Target'){echo 'selected'; } ?>> Kurang Target</option>
                        <option value="Nihil Target" <?php if($hasil['capaian_sasaran']=='Nihil Target'){echo 'selected'; } ?>> Nihil Target</option>
                    </select>
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_sasaran" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_sasaran" name="ket_capaian_sasaran" rows="3" required><?php echo $hasil['ket_capaian_sasaran']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_waktu" class="col-sm-2 col-form-label">Capaian Waktu</label>
                    <div class="col-sm-10">
                    <select name="capaian_waktu" class="form-control" id='capaian_waktu' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option value="Sesuai Target" <?php if($hasil['capaian_waktu']=='Sesuai Target'){echo 'selected'; } ?> > Sesuai Target</option>
                        <option value="Lebih Target" <?php if($hasil['capaian_waktu']=='Lebih Target'){echo 'selected'; } ?>> Lebih Target</option>
                        <option value="Kurang Target" <?php if($hasil['capaian_waktu']=='Kurang Target'){echo 'selected'; } ?>> Kurang Target</option>
                        <option value="Nihil Target" <?php if($hasil['capaian_waktu']=='Nihil Target'){echo 'selected'; } ?>> Nihil Target</option>
                    </select>
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_waktu" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_waktu" name="ket_capaian_waktu" rows="3" required><?php echo $hasil['ket_capaian_waktu']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="capaian_tempat" class="col-sm-2 col-form-label">Capaian Tempat</label>
                    <div class="col-sm-10">
                    <select name="capaian_tempat" class="form-control" id='capaian_tempat' required>
                    <option value=''> --Pilih capaian-- </option>
                        <option value="Sesuai Target" <?php if($hasil['capaian_tempat']=='Sesuai Target'){echo 'selected'; } ?> > Sesuai Target</option>
                        <option value="Lebih Target" <?php if($hasil['capaian_tempat']=='Lebih Target'){echo 'selected'; } ?>> Lebih Target</option>
                        <option value="Kurang Target" <?php if($hasil['capaian_tempat']=='Kurang Target'){echo 'selected'; } ?>> Kurang Target</option>
                        <option value="Nihil Target" <?php if($hasil['capaian_tempat']=='Nihil Target'){echo 'selected'; } ?>> Nihil Target</option>
                    </select>
                    <br>
                        <div class="form-group row">
                            <label for="ket_capaian_tempat" class="col-sm-2 col-form-label">Keterangan/ Penjelasan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ket_capaian_tempat" name="ket_capaian_tempat" rows="3" required><?php echo $hasil['ket_capaian_tempat']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>  
                <div class="panel-footer mt-5 text-center">
                    <button type="submit" name='ubah' class="btn btn-success  mr-5">Ubah</button>
                    <a href="k" class="btn btn-danger">Batal</a>
                 </div>
            </form>
        </div>
    </div>
</div>

<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $kd_jemaat=$_POST['kd_jemaat'];
    $kd_seksi=$_POST['seksi'];
    $kd_subseksi=$_POST['subseksi'];
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
   
    $query="UPDATE kegiatan SET kd_jemaat='$kd_jemaat',kd_seksi='$kd_seksi',kd_subseksi='$kd_subseksi',nomor_kegiatan='$nomor_kegiatan',periode='$periode',kegiatan='$kegiatan',indikator='$indikator',capaian_keg='$capaian_keg',ket_capaian_keg='$ket_capaian_keg',capaian_biaya='$capaian_biaya',ket_capaian_biaya='$ket_capaian_biaya',capaian_sasaran='$capaian_sasaran', ket_capaian_sasaran='$ket_capaian_sasaran', capaian_waktu='$capaian_waktu', ket_capaian_waktu='$ket_capaian_waktu',capaian_tempat='$capaian_tempat', ket_capaian_tempat='$ket_capaian_tempat',nilai_capaian_keg='$nilai_capaian_keg',nilai_biaya='$nilai_biaya',nilai_sasaran='$nilai_sasaran',nilai_waktu='$nilai_waktu',nilai_tempat='$nilai_tempat',nilai_capaian='$nilai_capaian',nilai_kategori='$nilai_kategori',nilai_capaian_subbidang='$nilai_capaian_subbidang',realisasi='$realisasi' WHERE id_kegiatan=$id";


   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Kegiatan Jemaat berhasil diubah');window.location='k';</script>"; 
             }
      else {
            echo "gagal";
            }           
}
?>
<!-- endFungsiEditData -->


<!-- scriptForComboBoxBertingkat -->
<script src="../vendor/jquery/jquery-1.10.2.min.js"></script>
<script src="../vendor/jquery/jquery.chained.min.js"></script>
<script>
    $("#subseksi").chained("#seksi");
</script>


<?php
include '../footer.php';
?>