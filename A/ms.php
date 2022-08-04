<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master seksi
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
    <li class="breadcrumb-item"><a href="mu">Seksi dalam Jemaat</a></li>
  </ul>
</div>

<div class="container-fluid"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Master Seksi / Bagian 
  </div>
  <div class="card-body table-responsive">
 
  <a href="ms?aksi=add" class="btn btn-success mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
				<th>Nama Jemaat</th>
                <th> Kode Seksi</th>
                <th> Nama Seksi</th>
				<th>Ketua Seksi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT *, jemaat.kd_jemaat, jemaat.nama_jemaat  
        FROM seksi
        INNER JOIN jemaat ON jemaat.kd_jemaat=seksi.kd_jemaat
        ORDER BY id_seksi DESC";

		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nama_jemaat']; ?></td>
                <td><?php echo $hasil['kd_seksi']; ?></td>
				<td><?php echo $hasil['nama_seksi']; ?></td>
				<td><?php echo $hasil['ketua'];  ?></td>
				<td class='text-center' > <a href='ms?aksi=edit&id= <?php echo $hasil['id_seksi'] ;?> ' class='btn-sm btn-warning fas fa-edit' > </a>
     
           		<a href="ms?aksi=delete&id=<?php echo $hasil['id_seksi'] ;?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
        $queri="DELETE FROM seksi WHERE id_seksi=$id ";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='ms'; </script>";
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
        <li class='breadcrumb-item'><a href='ms'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='ms?aksi=add'>Tambah Master Seksi/ Bagian</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h5 text-center"> Tambah Master Seksi / Bagian</div>
            <div class="card-body">
                <form action="" method="POST">
                <div class="form-group">
                    <label for="kd_jemaat">Nama Jemaat:</label>
                    <!-- <input type="text" class="form-control" id="id_jemaat" placeholder="" name="id_jemaat"> -->

                    <select name="kd_jemaat" id='kd_jemaat' class="form-control">
                        <?php      
                            $queri="SELECT * FROM jemaat";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kd_jemaat'].  "' >".$res['nama_jemaat']. "</option>";}
                        ?>     
                    </select>
                </div>
                <div class="form-group">
                    <label for="kd_seksi">Kode Seksi :</label>
                    <input type="text" class="form-control" id="kd_seksi" placeholder="" name="kd_seksi">
                </div>
                <div class="form-group">
                    <label for="nama_seksi">Nama Seksi :</label>
                    <input type="text" class="form-control" id="nama_seksi" placeholder="" name="nama_seksi">
                </div>
                <div class="form-group">
                    <label for="ketua">Nama Ketua Seksi :</label>
                    <input type="text" class="form-control" id="ketua" placeholder="" name="ketua">
                </div>
               
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="ms" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $kd_jemaat = $_POST['kd_jemaat'];
    $kd_seksi = $_POST['kd_seksi'];
    $nama_seksi = $_POST['nama_seksi'];
    $ketua=$_POST['ketua'];

    $query="INSERT INTO seksi (kd_jemaat, kd_seksi, nama_seksi, ketua) VALUES ('$kd_jemaat', '$kd_seksi','$nama_seksi','$ketua')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan Master Seksi / Bagian '); window.location='ms'; </script>" ;
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
		<li class="breadcrumb-item"><a href="mu?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update Master Seksi / Bagian</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT *, jemaat.kd_jemaat, jemaat.nama_jemaat 
FROM seksi 
INNER JOIN jemaat ON jemaat.kd_jemaat=seksi.kd_jemaat
where id_seksi=$id";
$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Master Seksi / Bagian</div>
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
         
         <label for="kd_seksi" class="">Kode Seksi:</label>
         <input name="kd_seksi" type="text" class="form-control" id="kd_seksi" placeholder="Nama Seksi / Bagian" value="<?php echo $hasil['kd_seksi']; ?>">
         <br>     

  		<label for="nama_seksi" class="">Nama Seksi:</label>
         <input name="nama_seksi" type="text" class="form-control" id="nama_seksi" placeholder="Nama Seksi / Bagian" value="<?php echo $hasil['nama_seksi']; ?>">
         <br>
       
         <label for='ketua'>Nama Ketua</label>
         <input name="ketua" type="text" class="form-control" id="ketua" placeholder="Ketua" value="<?php echo $hasil['ketua']; ?>">
         <br>

         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="ms" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
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
    $kd_seksi = $_POST['kd_seksi'];
    $nama_seksi = $_POST['nama_seksi'];
    $ketua=$_POST['ketua'];
   
   $query = "UPDATE seksi set kd_jemaat='$kd_jemaat',kd_seksi='$kd_seksi', nama_seksi='$nama_seksi', ketua='$ketua' WHERE id_seksi=$id";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master Seksi / Bagian berhasil diubah');window.location='ms';</script>"; 
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



