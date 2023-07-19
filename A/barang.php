<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master barang
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
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="barang">Barang</a></li>
  </ul>
</div>

<div class="container-fluid"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Master Barang 
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="barang?aksi=add" class="btn btn-success mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
				<th>Kode Barang</th>
                <th> Nama Barang</th>
                <th> Kategori</th>
                <th> Merek</th>
                <th> Detail</th>
				<th>Stok Awal</th>
                <th>Satuan Barang</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT *, kategori.nama_kategori, merek.kode_merek, satuan_barang.id_satuan
        FROM barang
        INNER JOIN kategori ON kategori.kode_kategori=barang.kode_kategori
        INNER JOIN merek ON merek.kode_merek=barang.kode_merek
        INNER JOIN satuan_barang ON satuan_barang.id_satuan=barang.id_satuan_barang
        ORDER BY nama_barang ASC";
        
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['kode_barang']; ?></td>
				<td><?php echo $hasil['nama_barang']; ?></td>
                <td><?php echo $hasil['nama_kategori']; ?></td>
                <td><?php echo $hasil['nama_merek']; ?></td>
                <td><?php echo $hasil['detail_barang']; ?></td>
				<td><?php echo $hasil['stok_awal'];  ?></td>
                <td><?php echo $hasil['nama_satuan'];  ?></td>
				<td class='text-center'> <a href="barang?aksi=edit&kode=<?php echo $hasil['kode_barang'];?>" class='btn-sm btn-success fas fa-edit' > </a>
     
           		<a href="barang?aksi=delete&kode=<?php echo $hasil['kode_barang'] ;?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
    if(isset($_GET['aksi']) && isset($_GET['kode']) ){
        $kode=$_GET['kode'];
        $queri="DELETE FROM barang WHERE kode_barang='$kode'";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='barang'; </script>";
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
        <li class='breadcrumb-item'><a href='#'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='barang?aksi=add'>Tambah Barang</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h5 text-center"> Tambah Barang</div>
            <div class="card-body">
                <form action="" method="POST">

                <div class="form-group">
                    <label for="kode_barang">Kode Barang :</label>
                    <input type="text" class="form-control" id="kode_barang"  name="kode_barang" required/>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang :</label>
                    <input type="text" class="form-control" id="nama_barang"  name="nama_barang" required/>
                </div>

                <div class="form-group">
                    <label for="kode_kategori">Kategori:</label>
                    <!-- <input type="text" class="form-control" id="id_jemaat" placeholder="" name="id_jemaat"> -->
                    <select name="kode_kategori" id='kode_kategori' class="form-control" required/>
                    <option value=''> --Pilih--  </option>
                        <?php      
                            $queri="SELECT * FROM kategori";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kode_kategori'].  "' >".$res['nama_kategori']. "</option> ";}
                        ?>     
                    </select>

                </div>

                <div class="form-group">
                    <label for="kode_merek">Merek Barang :</label>
                    <select name="kode_merek" id='kode_merek' class="form-control" required/>
                    <option value=''> --Pilih--  </option>
                    <?php      
                            $queri="SELECT * FROM merek";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kode_merek']."'>".$res['nama_merek']."</option>";}
                        ?>     
                    </select>
                </div>

                <div class="form-group">
                    <label for="detail">Detail Barang :</label>
                    <input type="text" class="form-control" id="detail"  name="detail" required/>
                </div>

                
                <div class="form-group">
                    <label for="stok_awal">Stok Awal :</label>
                    <input type="number" class="form-control" id="stok_awal"  name="stok_awal" required/>
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
                    <a href="barang" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $kode_barang=$_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kode_kategori = $_POST['kode_kategori'];
    $kode_merek = $_POST['kode_merek'];
    $detail = $_POST['detail'];
    $stok_awal = $_POST['stok_awal'];
    $id_satuan=$_POST['id_satuan'];

    $query="INSERT INTO barang (kode_barang, nama_barang, kode_kategori, kode_merek, detail_barang, stok_awal,id_satuan_barang ) VALUES ('$kode_barang','$nama_barang', '$kode_kategori', '$kode_merek', '$detail','$stok_awal','$id_satuan')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan data barang'); window.location='barang'; </script>" ;
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
		<li class="breadcrumb-item"><a href="barang?aksi=view">Master Barang</a></li>
		<li class="breadcrumb-item"><a href="#">Update Barang</a></li>
	</ul>
	</div>
<?php	
$kode=$_GET['kode'];
$query="SELECT * FROM barang WHERE kode_barang='$kode'";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Master Barang</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
    <label for="kode_barang" class="">Kode Barang:</label>
         <input name="kode_barang" type="text" class="form-control" id="kode_barang" placeholder="" value="<?php echo $hasil['kode_barang']; ?>" readonly/>
         <small id=niphelp class="form-text text-muted">Jang mara boss, kode barang seng bisa diubah.</small>
         <br>

  		<label for="nama_barang" class="">Nama Barang:</label>
         <input name="nama_barang" type="text" class="form-control" id="nama_barang" placeholder="" value="<?php echo $hasil['nama_barang']; ?>">
         <br>

 		 <label for="kode_kategori">Kategori:</label>
        
         <select name="kode_kategori" id='kode_kategori' class="form-control">
         <option value=''> -- Pilih --  </option>
            <?php      
                $queri="SELECT * FROM kategori";
                $sql=mysqli_query($conn,$queri);
                while($res=mysqli_fetch_array($sql)){
                    
                    if($hasil['kode_kategori']==$res['kode_kategori']){
                        echo " <option value='".$res['kode_kategori']. "' selected>".$res['nama_kategori']. "</option> "; 
                    }  else {
                        echo " <option value='".$res['kode_kategori'].  "' >".$res['nama_kategori']. "</option> ";
                    }                 
                }
            ?>     
        </select>

         <br> 
         <label for="kode_merek">Merek Barang :</label>
         <select name="kode_merek" id='kode_merek' class="form-control">
         <option value=''> -- Pilih --  </option>
            <?php      
                $queri="SELECT * FROM merek";
                $sql=mysqli_query($conn,$queri);
                while($res=mysqli_fetch_array($sql)){
                    
                    if($hasil['kode_merek']==$res['kode_merek']){
                        echo " <option value='".$res['kode_merek']. "' selected>".$res['nama_merek']. "</option> "; 
                    }  else {
                        echo " <option value='".$res['kode_merek'].  "' >".$res['nama_merek']. "</option> ";
                    }                 
                }
            ?>     
        </select>
         <br>  

         <label for="detail">Detail Barang :</label>
         <input name="detail" type="text" class="form-control" id="detail" value="<?php echo $hasil['detail_barang']; ?>">
         <br>

         <label for="stok_awal">Stok Awal :</label>
         <input name="stok_awal" type="text" class="form-control" id="stok_awal" value="<?php echo $hasil['stok_awal']; ?>">
         <br>
       
         <label for="id_satuan">Satuan Barang :</label>
         <select name="id_satuan" id='id_satuan' class="form-control">
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

         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="barang" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $nama_barang = $_POST['nama_barang'];
    $kode_kategori = $_POST['kode_kategori'];
    $kode_merek = $_POST['kode_merek'];
    $detail = $_POST['detail'];
    $stok_awal = $_POST['stok_awal'];
    $satuan_barang=$_POST['satuan_barang'];
   
   $query = "UPDATE barang set nama_barang='$nama_barang', kode_kategori='$kode_kategori', kode_merek='$kode_merek', detail_barang='$detail', stok_awal='$stok_awal', id_satuan_barang='$satuan_barang' WHERE kode_barang='$kode'";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master Barang berhasil diubah');window.location='barang';</script>"; 
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
                $("#kode_kategori").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih"
                });
            });

            $(document).ready(function () {
                $("#kode_merek").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih"
                });
            });

            $(document).ready(function () {
                $("#id_satuan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih"
                });
            });
        </script>



<?php 
include '../footer.php';
?>



