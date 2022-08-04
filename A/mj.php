<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master Jemaat
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
        $queri="DELETE FROM jemaat WHERE id_jemaat=$id ";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='mj'; </script>";
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
        <li class='breadcrumb-item'><a href='mj'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='mj?aksi=add'>Tambah Master Jemaat</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h4 text-center"> Tambah Master Jemaat</div>
            <div class="card-body">
                <form action="" method="POST">
                <div class="form-group">
                    <label for="kd_jemaat">Kode Jemaat:</label>
                    <input type="text" class="form-control" id="kd_jemaat" placeholder="" name="kd_jemaat">
                </div>

                <div class="form-group">
                    <label for="nama_jemaat">Nama Jemaat:</label>
                    <input type="text" class="form-control" id="nama_jemaat" placeholder="" name="nama_jemaat">
                </div>
                <div class="form-group">
                    <label for="klasis">Klasis :</label>
                    <input type="text" class="form-control" id="klasis" placeholder="" name="klasis">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <input type="text" class="form-control" id="alamat" placeholder="" name="alamat">
                </div>
                <div class="form-group">
                    <label for="ketua_MJ">Ketua Majelis Jemaat :</label>
                    <input type="text" class="form-control" id="ketua_MJ" placeholder="" name="ketua_MJ">
                </div>
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="mj" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $nama_jemaat = $_POST['nama_jemaat'];
    $kd_jemaat = $_POST['kd_jemaat'];
    $klasis = $_POST['klasis'];
    $alamat=$_POST['alamat'];
    $ketua_MJ=$_POST['ketua_MJ'];

    $query="INSERT INTO jemaat (kd_jemaat, nama_jemaat, klasis, alamat, ketua_MJ) VALUES ('$kd_jemaat','$nama_jemaat','$klasis','$alamat','$ketua_MJ')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan Master Jemaat '); window.location='mj'; </script>" ;
    }else{
        echo "<script>alert('Terjadi kegagalan. ID telah terdaftar') </script>";
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
    <li class="breadcrumb-item"><a href="mj">Jemaat</a></li>
  </ul>
</div>

<div class="container"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Master Jemaat 
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="mj?aksi=add" class="btn btn-success mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
                <th>Kode Jemaat</th>
				<th>Nama Jemaat</th>
                <th> Klasis</th>
				<th>Alamat</th>
				<th>Ketua Majelis Jemaat</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT * FROM jemaat";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
                <td> <?php echo $hasil['kd_jemaat']; ?></td>
				<td><?php echo $hasil['nama_jemaat']; ?></td>
				<td><?php echo $hasil['klasis']; ?></td>
				<td><?php echo $hasil['alamat'];  ?></td>
				<td><?php echo $hasil['ketua_MJ'];  ?></td>
				<td class='text-center' > <a href='mj?aksi=edit&id= <?php echo $hasil['id_jemaat'] ;?> ' class='btn-sm btn-warning fas fa-edit' > </a>
     
           		<a href="mj?aksi=delete&id=<?php echo $hasil['id_jemaat'] ;?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
		<li class="breadcrumb-item"><a href="mu?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update Master Jemaat</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT * FROM jemaat where id_jemaat=$id";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Master Jemaat</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
         <label for="kd_jemaat" class="">Kode Jemaat</label>
         <input name="kd_jemaat" type="text" class="form-control" id="kd_jemaat" placeholder="kode jemaat" value="<?php echo $hasil['kd_jemaat']; ?>">
         <br>       
 		 <label for="nama_jemaat" class="">Nama Jemaat</label>
         <input name="nama_jemaat" type="text" class="form-control" id="nama_jemaat" placeholder="nama_jemaat" value="<?php echo $hasil['nama_jemaat']; ?>">
         <br>       
  		<label for="klasis" class="">Klasis:</label>
         <input name="klasis" type="text" class="form-control" id="klasis" placeholder="Nama Klasis" value="<?php echo $hasil['klasis']; ?>">
         <br>
       
         <label for='alamat'>Alamat</label>
         <input name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?php echo $hasil['alamat']; ?>">
       
         <br>
         <label for='active'> Ketua Majelis Jemaat</label>
         <input name="ketua_MJ" type="text" class="form-control" id="ketua_MJ" placeholder="ketua_MJ" value="<?php echo $hasil['ketua_MJ']; ?>">
         <br>


         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="mj" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
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
    $nama_jemaat = $_POST['nama_jemaat'];
    $klasis = $_POST['klasis'];
    $alamat=$_POST['alamat'];
    $ketua_MJ=$_POST['ketua_MJ'];
   
   $query = "UPDATE jemaat set kd_jemaat='kd_jemaat',nama_jemaat='$nama_jemaat', klasis='$klasis', alamat='$alamat', ketua_MJ='$ketua_MJ' WHERE id_jemaat=$id ";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master Jemaat berhasil diubah');window.location='mj';</script>"; 
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



