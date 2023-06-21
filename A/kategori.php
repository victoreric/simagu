<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master kategori
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
    if(isset($_GET['aksi']) && isset($_GET['kode']) ){
        $kode=$_GET['kode'];
        $queri="DELETE FROM kategori WHERE kode_kategori='$kode'";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='kategori'; </script>";
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
        <li class='breadcrumb-item'><a href='kategori'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='kategori?aksi=add'>Tambah Kategori Barang</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h4 text-center"> Tambah kategori barang</div>
            <div class="card-body">
                <form action="" method="POST">
                <div class="form-group">
                    <label for="kode_kategori">Kode Kategori:</label>
                    <input type="text" class="form-control" id="kode_kategori" placeholder="" name="kode_kategori" maxlength="10">
                </div>

                <div class="form-group">
                    <label for="nama_kategori">Kategori Barang:</label>
                    <input type="text" class="form-control" id="nama_kategori" placeholder="" name="nama_kategori" maxlength="50">
                </div>
             
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="kategori" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $kode_kategori = $_POST['kode_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    $query="INSERT INTO kategori (kode_kategori, nama_kategori) VALUES ('$kode_kategori','$nama_kategori')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan kategori barang '); window.location='kategori'; </script>" ;
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
    <li class="breadcrumb-item"><a href="#">Kode Kategori</a></li>
    <li class="breadcrumb-item"><a href="kategori">Kategori barang</a></li>
  </ul>
</div>

<div class="container"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Kategori Barang
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="kategori?aksi=add" class="btn btn-info mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
                <th>Kode Kategori</th>
				<th>Kategori Barang</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT * FROM kategori";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
                <td> <?php echo $hasil['kode_kategori']; ?></td>
				<td><?php echo $hasil['nama_kategori']; ?></td>
				<td class='text-center'><a href='kategori?aksi=edit&kode=<?php echo $hasil['kode_kategori'];?>' class='btn-sm btn-success fas fa-edit' > </a>
     
           		<a href="kategori?aksi=delete&kode=<?php echo $hasil['kode_kategori'];?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
		<li class="breadcrumb-item"><a href="kategori?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update Kategori barang</a></li>
	</ul>
	</div>
<?php	
$kode=$_GET['kode'];
$query="SELECT * FROM kategori WHERE kode_kategori='$kode'";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Kategori Barang</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
         <label for="kode_kategori" class="">Kode Kategori</label>
         <input name="kode_kategori" type="text" class="form-control" id="kode_kategori" placeholder=" kode kategori" value="<?php echo $hasil['kode_kategori']; ?>" readonly/>
         <small id=niphelp class="form-text text-muted">Jang mara boss, kode kategori seng bisa diubah.</small>
         <br>       
 		 <label for="nama_kategori" class="">Nama Kategori</label>
         <input name="nama_kategori" type="text" class="form-control" id="nama_kategori" placeholder="nama kategori" value="<?php echo $hasil['nama_kategori']; ?>">
         <br>       
  		
         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="kategori" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $kode_kategori_new= $_POST['kode_kategori'];
    $nama_kategori_new= $_POST['nama_kategori'];

   
   $query = "UPDATE kategori set nama_kategori='$nama_kategori_new' WHERE kode_kategori='$kode'";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master kategori berhasil diubah');window.location='kategori';</script>"; 
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



