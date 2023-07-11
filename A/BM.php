<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Pencatatan barang masuk
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
    <li class="breadcrumb-item"><a href="BM">Barang Masuk</a></li>
    <!-- <li class="breadcrumb-item"><a href="barang">Barang</a></li> -->
  </ul>
</div>

<div class="container-fluid"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Pencatatan Barang Masuk
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="BM?aksi=add" class="btn btn-success mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center text-white">
				<th>No.</th>
				<th>Nomor Nota / Keterangan</th>
                <th> Nama Barang</th>
                <th> Tanggal Barang Masuk </th>
                <th> Jumlah</th>
                <th>Satuan Barang</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
        // $query="SELECT * FROM barang_masuk";
		$query="SELECT *, barang.kode_barang, satuan_barang.id_satuan
        FROM barang_masuk
        LEFT JOIN barang ON barang.kode_barang=barang_masuk.kode_barang
        LEFT JOIN satuan_barang ON satuan_barang.id_satuan=barang_masuk.id_satuan_barang
        ORDER BY tanggal_bm DESC        
        ";
        
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nomor_nota']; ?></td>
				<td><?php echo $hasil['nama_barang']; ?></td>
                <td><?php echo tanggal_indo($hasil['tanggal_bm']); ?></td>
                <td><?php echo $hasil['jumlah']; ?></td>
                <td><?php echo $hasil['nama_satuan']; ?></td>
				<td class='text-center'> <a href="BM?aksi=edit&id=<?php echo $hasil['id_bm'];?>" class='btn-sm btn-success fas fa-edit' > </a>
     
           		<a href="BM?aksi=delete&id=<?php echo $hasil['id_bm'] ;?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
        $queri="DELETE FROM barang_masuk WHERE id_bm=$id";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='BM'; </script>";
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
        <li class='breadcrumb-item'><a href='BM'>Barang Masuk</a></li>
        <li class='breadcrumb-item'><a href='BM?aksi=add'>Tambah data</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h5 text-center"> Barang Masuk</div>
            <div class="card-body">
                <form action="" method="POST">

                <div class="form-group">
                    <label for="nomor_nota">Nomor Nota:</label>
                    <input type="text" class="form-control" id="nomor_nota" placeholder="" name="nomor_nota" required/>
                </div>

                <div class="form-group">
                    <label for="tanggal_bm">tanggal barang masuk :</label>
                    <input type="date" class="form-control" id="tanggal_bm" placeholder="" name="tanggal_bm" required/>
                </div>

                <div class="form-group">
                    <label for="kode_barang">Nama Barang:</label>
                    <select name="kode_barang" id='kode_barang' class="form-control" required/>
                    <option value=''> --Pilih--  </option>
                        <?php                            
                            $queri=" SELECT *, satuan_barang.nama_satuan  
                            FROM barang
                            LEFT JOIN satuan_barang ON barang.id_satuan_barang=satuan_barang.id_satuan
                            ";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kode_barang'].  "' >".$res['nama_barang']. " -->(Dalam Satuan : " .$res['nama_satuan'] . "</option> ";}
                        ?>     
                    </select>
                </div>

                
                <div class="form-group">
                    <label for="jumlah">Jumlah Barang2 :</label>
                    <input type="text" class="form-control" id="jumlah" placeholder="" name="jumlah" onkeypress="return Angkasaja(event)" required/>
                </div>
            
                <div class="form-group">
                    
                    <label for="id_satuan">Satuan Barang :</label>
                    <select name="id_satuan" id='id_satuan' class="form-control" required/>
                    <option value=''> --Pilih--  </option>
                    <?php      
                            $queri="SELECT * FROM satuan_barang";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['id_satuan']."'>".$res['nama_satuan']."</option>";}
                        ?>     
                    </select>
                </div>
               
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="BM" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $nomor_nota=$_POST['nomor_nota'];
    $kode_barang = $_POST['kode_barang'];
    $tanggal_bm = $_POST['tanggal_bm'];
    $jumlah = $_POST['jumlah'];
    $id_satuan = $_POST['id_satuan'];

    $query="INSERT INTO barang_masuk (nomor_nota, kode_barang, tanggal_bm, jumlah,id_satuan_barang ) VALUES ('$nomor_nota','$kode_barang', '$tanggal_bm', '$jumlah', '$id_satuan')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan data barang masuk'); window.location='BM'; </script>" ;
    }else{
        echo "<script>alert('Terjadi kegagalan. ID telah terdaftar') </script>";
    }
}
} 
// endtambahdata


// fungsiEditData
function edit($conn){  ?>
	<div>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
		<li class="breadcrumb-item"><a href="BM">Barang Masuk</a></li>
		<li class="breadcrumb-item"><a href="#">Edit data</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT * 
FROM barang_masuk 
WHERE id_bm=$id";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit barang masuk</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
    <label for="nomor_nota" class="">Nomor Nota:</label>
         <input name="nomor_nota" type="text" class="form-control" id="nomor_nota" value="<?php echo $hasil['nomor_nota']; ?>">
        <br>

  		<label for="kode_barang" class="">Nama Barang:</label>
          <select name="kode_barang" id='kode_barang' class="form-control">
         <option value=''> -- Pilih --  </option>
            <?php      
                $queri="SELECT * FROM barang";
                $sql=mysqli_query($conn,$queri);
                while($res=mysqli_fetch_array($sql)){
                    
                    if($hasil['kode_barang']==$res['kode_barang']){
                        echo " <option value='".$res['kode_barang']. "' selected>".$res['nama_barang']. "</option> "; 
                    }  else {
                        echo " <option value='".$res['kode_barang'].  "' >".$res['nama_barang']. "</option> ";
                    }                 
                }
            ?>     
        </select>
         <br>

         <label for="tanggal_bm">Tanggal Nota :</label>
         <input name="tanggal_bm" type="date" class="form-control" id="tanggal_bm" value="<?php echo $hasil['tanggal_bm']; ?>">
         <br>

         <label for="jumlah">Jumlah Barang :</label>
         <input name="jumlah" type="text" class="form-control" id="jumlah" value="<?php echo $hasil['jumlah']; ?>">
         <br>

         <select name="satuan_barang" id='satuan_barang' class="form-control">
         <option value=''> -- Pilih Satuan --  </option>
            <?php      
                $queri="SELECT * FROM satuan_barang";
                $sql=mysqli_query($conn,$queri);
                while($res=mysqli_fetch_array($sql)){
                    
                    if($hasil['id_satuan_barang']==$res['id_satuan']){
                        echo " <option value='".$res['id_satuan']. "' selected>".$res['nama_satuan']. "</option> "; 
                    }  else {
                        echo " <option value='".$res['id_satuan'].  "' >".$res['nama_satuan']. "</option> ";
                    }                 
                }
            ?>     
        </select>
         <br>

         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="BM" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $nomor_nota = $_POST['nomor_nota'];
    $kode_barang = $_POST['kode_barang'];
    $tanggal_bm = $_POST['tanggal_bm'];
    $jumlah = $_POST['jumlah'];
    $satuan_barang = $_POST['satuan_barang'];
   
   $query = "UPDATE barang_masuk set nomor_nota='$nomor_nota', kode_barang='$kode_barang', tanggal_bm='$tanggal_bm', jumlah='$jumlah', id_satuan_barang='$satuan_barang' WHERE id_bm=$id";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Barang masuk berhasil diubah');window.location='BM';</script>"; 
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

 <!-- wajib jquery  -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <!-- js untuk bootstrap4  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script>
        <!-- js untuk select2  -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#kode_barang").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih"
                });
            });
        </script>

<!-- Script input hanya angka -->
<script type="text/javascript">
function Angkasaja(evt) {
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
</script>

<?php 
include '../footer.php';
?>



