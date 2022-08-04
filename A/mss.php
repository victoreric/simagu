<?php include 'menuA.php';
include '../link.php';?>

<?php
// Program Utama MENU Master Sub Seksi
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
    <li class="breadcrumb-item"><a href="mss">Sub Seksi dalam Jemaat</a></li>
  </ul>
</div>

<div class="container-fluid"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5"> Master Sub Seksi / Bagian 
  </div>
  <div class="card-body table-responsive">
  <!-- <a href="" class="btn-sm btn-info far fa-file"> Tambah data </a> -->
  <!-- <p></p> -->
  <a href="mss?aksi=add" class="btn btn-success mb-2 fa fa-plus-circle" role="button"> </a>
  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center">
				<th>No.</th>
				<th>Nama Jemaat</th>
                <th> Nama Seksi</th>
                <th> Kode Sub Seksi</th>
                <th> Nama Sub Seksi</th>
				<th>Ketua Sub Seksi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		$no=0;
		$query="SELECT *, jemaat.kd_jemaat, jemaat.nama_jemaat, seksi.kd_seksi, seksi.nama_seksi
        FROM subseksi
        INNER JOIN jemaat ON jemaat.kd_jemaat=subseksi.kd_jemaat
        INNER JOIN seksi ON seksi.kd_seksi=subseksi.kd_seksi
        ORDER BY id_subseksi DESC";
        
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nama_jemaat']; ?></td>
				<td><?php echo $hasil['nama_seksi']; ?></td>
                <td><?php echo $hasil['kd_subseksi']; ?></td>
                <td><?php echo $hasil['nama_subseksi']; ?></td>
				<td><?php echo $hasil['ketua_subseksi'];  ?></td>
				<td class='text-center' > <a href='mss?aksi=edit&id=<?php echo $hasil['id_subseksi'] ;?> ' class='btn-sm btn-warning fas fa-edit' > </a>
     
           		<a href="mss?aksi=delete&id=<?php echo $hasil['id_subseksi'] ;?>" class="btn-sm btn-danger fas fa-trash-alt mt-2" onclick="javascript:return confirm('Anda Yakin menghapus data ini?')" >  </a> 
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
        $queri="DELETE FROM subseksi WHERE id_subseksi=$id ";
        $sql=mysqli_query($conn,$queri);

        if($sql){
            echo "<script>alert('Berhasil menghapus data');window.location='mss'; </script>";
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
        <li class='breadcrumb-item'><a href='mss'>Master Data</a></li>
        <li class='breadcrumb-item'><a href='mss?aksi=add'>Tambah Master Sub Seksi</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white h5 text-center"> Tambah Master Sub Seksi</div>
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
                            echo " <option value='".$res['kd_jemaat'].  "' >".$res['nama_jemaat']. "</option>     ";}
                        ?>     
                    </select>

                </div>
                <div class="form-group">
                    <label for="kd_seksi">Nama Seksi :</label>
                    <!-- <input type="text" class="form-control" id="id_seksi" placeholder="" name="id_seksi"> -->
                    <select name="kd_seksi" id='kd_seksi' class="form-control">
                        <?php      
                            $queri="SELECT * FROM seksi";
                            $sql=mysqli_query($conn,$queri);
                            while($res=mysqli_fetch_array($sql)){
                            echo " <option value='".$res['kd_seksi']."'>".$res['nama_seksi']."</option>";}
                        ?>     
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_subseksi">Kode Sub Seksi :</label>
                    <input type="text" class="form-control" id="kd_subseksi" placeholder="" name="kd_subseksi">
                </div>
                <div class="form-group">
                    <label for="nama_subseksi">Nama Sub Seksi :</label>
                    <input type="text" class="form-control" id="nama_subseksi" placeholder="" name="nama_subseksi">
                </div>
                <div class="form-group">
                    <label for="ketua">Nama Ketua Sub Seksi :</label>
                    <input type="text" class="form-control" id="ketua" placeholder="" name="ketua">
                </div>
               
                <div class="panel-footer mt-5">
                    <button type="submit" name='simpan' class="btn btn-success  mr-5">Simpan</button>
                    <a href="mss" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>   
<?php 
if(isset($_POST['simpan'])){
    $kd_jemaat = $_POST['kd_jemaat'];
    $kd_seksi = $_POST['kd_seksi'];
    $kd_subseksi = $_POST['kd_subseksi'];
    $nama_subseksi = $_POST['nama_subseksi'];
    $ketua=$_POST['ketua'];

    $query="INSERT INTO subseksi (kd_jemaat, kd_seksi, kd_subseksi, nama_subseksi, ketua_subseksi) VALUES ('$kd_jemaat','$kd_seksi', '$kd_subseksi', '$nama_subseksi','$ketua')";
    $sql=mysqli_query($conn,$query);

    if($sql){
        echo "<script> alert ('Berhasil menambahkan Master Seksi / Bagian '); window.location='mss'; </script>" ;
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
		<li class="breadcrumb-item"><a href="mss?aksi=view">Master Data</a></li>
		<li class="breadcrumb-item"><a href="#">Update Master Sub Seksi / Bagian</a></li>
	</ul>
	</div>
<?php	
$id=$_GET['id'];
$query="SELECT *, jemaat.kd_jemaat, jemaat.nama_jemaat
FROM subseksi 
INNER JOIN jemaat ON jemaat.kd_jemaat=subseksi.kd_jemaat
where id_subseksi=$id";

$sql=mysqli_query($conn,$query);
$hasil=mysqli_fetch_array($sql);
?>

<div class="container">
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h5">Edit Master Sub Seksi / Bagian</div>
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
         <label for="id_seksi" class="">Nama Seksi</label>
         <select name="kd_seksi" id='kd_seksi' class="form-control">
         <option value=''> -- Pilih Seksi --  </option>
            <?php      
                $queri="SELECT * FROM seksi";
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
         <br>  
         <label for="kd_subseksi" class="">Kode Sub Seksi:</label>
         <input name="kd_subseksi" type="text" class="form-control" id="kd_subseksi" placeholder="Kode Sub Seksi / Bagian" value="<?php echo $hasil['kd_subseksi']; ?>">
         <br>

  		<label for="nama_subseksi" class="">Nama Sub Seksi:</label>
         <input name="nama_subseksi" type="text" class="form-control" id="nama_subseksi" placeholder="Nama Sub Seksi / Bagian" value="<?php echo $hasil['nama_subseksi']; ?>">
         <br>
       
         <label for='ketua'>Nama Ketua</label>
         <input name="ketua" type="text" class="form-control" id="ketua" placeholder="Ketua" value="<?php echo $hasil['ketua_subseksi']; ?>">
         <br>

         <br>
         <div class='text-center'>
         <input class="btn btn-success btn-submit" type="submit" name="ubah" value="Ubah">
         <a href="mss" ><input class="btn btn-success btn-danger" type="button" value="Batal"></a>
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
    $kd_seksi = $_POST['kd_seksi'];
    $kd_subseksi = $_POST['kd_subseksi'];
    $nama_subseksi = $_POST['nama_subseksi'];
    $ketua=$_POST['ketua'];
   
   $query = "UPDATE subseksi set kd_jemaat='$kd_jemaat', kd_seksi='$kd_seksi', kd_subseksi='$kd_subseksi', nama_subseksi='$nama_subseksi', ketua_subseksi='$ketua' WHERE id_subseksi=$id";

   $sql= mysqli_query($conn,$query); 

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :   
              echo "<script> alert ('Master Sub Seksi / Bagian berhasil diubah');window.location='mss';</script>"; 
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



