<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Management user
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "edit":
            edit($conn);
            break;
        case "delete":
            delete($conn);
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
    <li class="breadcrumb-item"><a href="mu">Manajemen Akun Pengguna</a></li>
  </ul>
</div>

<div class="container"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Managemen akun pengguna 
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
				<th>Nama Lengkap</th>
        <th>Username</th>
				<th>Level</th>
				<th>Active</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT * FROM login";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nama']; ?></td>
				<td><?php echo $hasil['username']; ?></td>
				<td><?php echo $hasil['level'];  ?></td>
				<td><?php echo $hasil['active'];  ?></td>
				<td class='text-center' > <a href='mu?aksi=edit&id= <?php echo $hasil['id_login'] ;?> ' class='btn-sm btn-success fas fa-edit' > </a>
     
           		<a href="mu?aksi=delete&id=<?php echo $hasil['id_login'] ;?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
// fungsuiDeletedata
function delete($conn){
  if(isset($_GET['aksi']) && isset($_GET['id']) ){
      $id=$_GET['id'];
      $queri="DELETE FROM login WHERE id_login=$id ";
      $sql=mysqli_query($conn,$queri);

      if($sql){
          echo "<script>alert('Berhasil menghapus data');window.location='mu'; </script>";
      }
  }
}
 // endFungsiDeleteData 
?>

<?php
// fungsi edit data
function edit($conn){  ?>
	<div>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
		<li class="breadcrumb-item"><a href="#">Master Data</a></li>
		<li class="breadcrumb-item"><a href="mu?aksi=view">Manajemen Akun Pengguna</a></li>
		<li class="breadcrumb-item"><a href="#">Update Akun Pengguna</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT * FROM login where id_login=$id";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit User Account</div>
  <div class="card-body">
  <form method="POST" action="" enctype="multipart/form-data">  
      <label for="nama" class="">Nama:</label>
         <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?php echo $hasil['nama']; ?>">
         <br>       
  		<label for="username" class="">Username:</label>
         <input name="username" type="text" class="form-control" id="username" placeholder="username" value="<?php echo $hasil['username']; ?>">
         <br>
       
         <label for='level'>Level</label>
         <select name="level" id="level" class="form-control">
            <option value="1" <?php if($hasil['level']=='1'){echo 'selected';} ?>>Administrator</option>
            <option value="2" <?php if($hasil['level']=='2'){echo 'selected';}  ?>>User</option>
         </select>
         
         <br>
         <label for='active'> Active</label>
         <select name='active' id='active' class="form-control">
            <option value="Y" <?php if($hasil['active']=='Y'){echo 'selected'; }  ?>> Ya</option>
            <option value="N" <?php if($hasil['active']=='N'){echo 'selected';}  ?> >Tidak</option>
         </select>
         <br>

         <a href="#demo" class="btn btn-warning text-dark" data-toggle="collapse">Klik disini untuk ganti password</a>
         <div id="demo" class="collapse">
           
            <input type="checkbox" size="30px" name="klikubah" value="true"> Ceklis jika ingin mengubah password<br>
            <label for="inputpassword" class="">Masukan Password Baru:</label>
                <input name="inputpassword" type="password" class="form-control" id="inputpassword" placeholder="Password baru">
         </div>
         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="mu" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
         </div>
      </form>
  </div>
</div>
</div>


<?php  
//proses edit data  
if (isset($_POST['ubah']))
{
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level=$_POST['level'];
    $active=$_POST['active'];
   
   $query = "UPDATE login set nama='$nama', username='$username', level='$level', active='$active' WHERE id_login=$id ";

   $sql= mysqli_query($conn,$query);

   if(isset($_POST['klikubah'])){
      $newpass=md5($_POST['inputpassword']);
      $nama = $_POST['nama'];
      $username = $_POST['username'];
      $level=$_POST['level'];
      $active=$_POST['active'];

      $query2 = "UPDATE login set nama='$nama', username='$username', password='$newpass', level='$level', active='$active' WHERE id_login=$id";

      $sql2= mysqli_query($conn,$query2);

      if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
         // Jika Sukses, Lakukan :   
       echo "<script> alert ('User Account dan password berhasil diubah');window.location='mu';</script>"; 
      }
else {
     echo "gagal";
     } 
   }
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('User Account berhasil diubah');window.location='mu';</script>"; 
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



