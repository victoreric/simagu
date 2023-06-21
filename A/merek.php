<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master merek barang
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
        $queri="DELETE FROM merek WHERE kode_merek='$kode'";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='merek'; </script>";
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
        <li class='breadcrumb-item'><a href='merek'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='merek?aksi=add'>Tambah merek Barang</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h4 text-center"> Tambah merek barang</div>
            <div class="card-body">
                <form action="" method="POST">
                <div class="form-group">
                    <label for="kode_merek">Kode merek:</label>
                    <input type="text" class="form-control" id="kode_merek" placeholder="" name="kode_merek" maxlength="10">
                </div>

                <div class="form-group">
                    <label for="nama_merek">Kategori Barang:</label>
                    <input type="text" class="form-control" id="nama_merek" placeholder="" name="nama_merek" maxlength="50">
                </div>
             
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="merek" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $kode_merek = $_POST['kode_merek'];
    $nama_merek = $_POST['nama_merek'];

    $query="INSERT INTO merek (kode_merek, nama_merek) VALUES ('$kode_merek','$nama_merek')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan merek barang '); window.location='merek'; </script>" ;
    }else{
        echo "<script>alert('Terjadi kegagalan. Kode merek telah terdaftar') </script>";
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
    <li class="breadcrumb-item"><a href="#">Kode Merek</a></li>
    <li class="breadcrumb-item"><a href="merek">Merek barang</a></li>
  </ul>
</div>

<div class="container"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Merek Barang
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="merek?aksi=add" class="btn btn-info mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
                <th>Kode merek</th>
				<th>Merek Barang</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT * FROM merek";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
                <td> <?php echo $hasil['kode_merek']; ?></td>
				<td><?php echo $hasil['nama_merek']; ?></td>
				<td class='text-center'><a href='merek?aksi=edit&kode=<?php echo $hasil['kode_merek'];?>' class='btn-sm btn-success fas fa-edit' > </a>
     
           		<a href="merek?aksi=delete&kode=<?php echo $hasil['kode_merek'];?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
		<li class="breadcrumb-item"><a href="merek?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update merek barang</a></li>
	</ul>
	</div>
<?php	
$kode=$_GET['kode'];
$query="SELECT * FROM merek WHERE kode_merek='$kode'";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Kategori Barang</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
         <label for="kode_merek" class="">Kode Kategori</label>
         <input name="kode_merek" type="text" class="form-control" id="kode_merek" placeholder=" kode merek" value="<?php echo $hasil['kode_merek']; ?>" readonly/>
         <small id=niphelp class="form-text text-muted">Jang mara boss, kode merek seng bisa diubah.</small>
         <br>       
 		 <label for="nama_merek" class="">Merek Barang</label>
         <input name="nama_merek" type="text" class="form-control" id="nama_merek" placeholder="" value="<?php echo $hasil['nama_merek']; ?>">
         <br>       
  		
         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="merek" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $kode_merek_new= $_POST['kode_merek'];
    $nama_merek_new= $_POST['nama_merek'];

   
   $query = "UPDATE merek set nama_merek='$nama_merek_new' WHERE kode_merek='$kode'";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master merek berhasil diubah');window.location='merek';</script>"; 
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



