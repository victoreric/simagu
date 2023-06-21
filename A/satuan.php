<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master satuan barang
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
// hapus data
function delete($conn){
    if(isset($_GET['aksi']) && isset($_GET['id']) ){
        $id=$_GET['id'];
        $queri="DELETE FROM satuan_barang WHERE id_satuan=$id";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='satuan'; </script>";
        }
    }
}
// endhapus data
?>


<?php 
// tambahdata
function add($conn){ ?>
    <div>
        <ul class='breadcrumb'>
        <li class='breadcrumb-item'><a href='index'><i class='fas fa-home'></i></a></li>
        <li class='breadcrumb-item'><a href='satuan'>Master Satuan Barang</a></li>
        <li class='breadcrumb-item'><a href='satuan?aksi=add'>Tambah Satuan Barang</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h4 text-center"> Tambah satuan barang</div>
            <div class="card-body">
                <form action="" method="POST">
                <!-- <div class="form-group">
                    <label for="kode_kategori">Kode Kategori:</label>
                    <input type="text" class="form-control" id="kode_kategori" placeholder="" name="kode_kategori" maxlength="10">
                </div> -->

                <div class="form-group">
                    <label for="nama_satuan">Satuan Barang:</label>
                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" maxlength="20">
                </div>
             
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="satuan" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $nama_satuan = $_POST['nama_satuan'];

    $query="INSERT INTO satuan_barang (nama_satuan) VALUES ('$nama_satuan')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan Satuan barang '); window.location='satuan'; </script>" ;
    }else{
        echo "<script>alert('Terjadi kegagalan. Kode kategori telah terdaftar') </script>";
    }
}
} 
// endtambahdata
?>


<?php
// fungsi view data
function view($conn){ ?>
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
    <li class="breadcrumb-item"><a href="satuan">Satuan barang</a></li>
  </ul>
</div>

<div class="container"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Satuan Barang
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="satuan?aksi=add" class="btn btn-info mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
				<th>Satuan Barang</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT * FROM satuan_barang";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nama_satuan']; ?></td>
				<td class='text-center'><a href='satuan?aksi=edit&id=<?php echo $hasil['id_satuan'];?>' class='btn-sm btn-success fas fa-edit' > </a>
     
           		<a href="satuan?aksi=delete&id=<?php echo $hasil['id_satuan'];?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
				</td>
			</tr>
		
		<?php } ?>
		</table>
  </div>
</div>
</div>
<?php } 
// endFungsiViewData
?>


<?php
// fungsi edit data
function edit($conn){  ?>
	<div>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
		<li class="breadcrumb-item"><a href="satuan?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update Satuan barang</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT * FROM satuan_barang WHERE id_satuan=$id";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Satuan Barang</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
         <!-- <label for="kode_kategori" class="">Kode Kategori</label>
         <input name="kode_kategori" type="text" class="form-control" id="kode_kategori" placeholder=" kode kategori" value="<?php echo $hasil['kode_kategori']; ?>" readonly/>
         <small id=niphelp class="form-text text-muted">Jang mara boss, kode kategori seng bisa diubah.</small> -->
         <br>       
 		 <label for="nama_satuan" class="">Satuan barang</label>
         <input name="nama_satuan" type="text" class="form-control" id="nama_satuan" placeholder="nama kategori" value="<?php echo $hasil['nama_satuan']; ?>">
         <br>       
  		
         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="satuan" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $nama_satuan_new= $_POST['nama_satuan'];

   
   $query = "UPDATE satuan_barang set nama_satuan='$nama_satuan_new' WHERE id_satuan=$id";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master Satuan barang berhasil diubah');window.location='satuan';</script>"; 
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



