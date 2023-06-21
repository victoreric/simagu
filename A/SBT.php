<?php
include 'menuA.php';
include '../link.php';
?>

<!-- Main content starts -->
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Stok Opname Per Tanggal</a></li>
  </ul>
</div>

<div class="container-fluid">
    <form action="" method="POST" class="form-inline was-validated">
        <label for="tanggal_awal">Tanggal Awal :</label>
        <input type="date" class="form-control mb-2 mr-sm-2" id="tanggal_awal" name="tanggal_awal" required/>
    
        <label for="tanggal_akhir">Tanggal Akhir :</label>
        <input type="date" class="form-control mb-2 mr-sm-2" id="tanggal_akhir" name="tanggal_akhir" required/>

        <button type="submit" name='simpan' class="btn btn-primary mb-2">Lihat</button>
    </form> 

    <?php 
        if(isset($_POST['simpan'])){
        $tanggal_awal=$_POST['tanggal_awal'];
        $tanggal_akhir=$_POST['tanggal_akhir'];
            if($tanggal_awal>=$tanggal_akhir){
                echo "<script> alert ('Tanggal awal harus lebih kecil dari tanggal akhir. Silahkan diperbaiki'); window.location='SBT'; </script>";
            }
            // echo $tanggal_awal;
            // echo "<br>";
            // echo $tanggal_akhir;
    ?>
    <!-- tampilkan hasil  -->
    <div class="card shadow mb-4">
       
        <div class="card-header bg-dark text-white text-center h6">     Daftar Stok Opname<br>
            Barang Persediaan Fakultas Teknik Unpatti <br>
            Periode <?php echo tanggal_indo($tanggal_awal). "  sampai dengan  " . tanggal_indo($tanggal_akhir) ;?>
        </div>

         <div class="card-body table-responsive" style="color:black">
         <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center text-white">
				<th>No.</th>
                <th> Nama Barang</th>
                <th colspan="2"> Volume masuk</th>
                <th colspan="2"> Volume keluar</th>
                <th colspan="2"> Sisa Barang (Stok Opname) </th>
                <th></th>
			</tr>
		</thead>
		<?php
		$no=0;
         $query="SELECT DISTINCT barang_masuk.kode_barang, barang.nama_barang, satuan_barang.nama_satuan 
         FROM barang_masuk
         LEFT JOIN barang ON barang.kode_barang=barang_masuk.kode_barang 
         LEFT JOIN satuan_barang ON satuan_barang.id_satuan=barang_masuk.id_satuan_barang
         WHERE tanggal_bm BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
         ";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
            $cek1=$hasil['kode_barang'];
            

        // volume barang masuk
        $queriBM="SELECT sum(jumlah) AS Jum_BM
        FROM barang_masuk
        WHERE kode_barang='$cek1' AND  tanggal_bm BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        $sqlBM=mysqli_query($conn,$queriBM);
        $hasilBM=mysqli_fetch_assoc($sqlBM);

         // volume barang keluar
         $queriBK="SELECT sum(jumlah) AS Jum_BK
         FROM barang_keluar
         WHERE kode_barang='$cek1' AND  tanggal_bk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
         $sqlBK=mysqli_query($conn,$queriBK);
         $hasilBK=mysqli_fetch_assoc($sqlBK);

            //isi di tabel
			$no++;
		?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nama_barang']; ?></td>
                
            
				<td><?php  echo $hasilBM['Jum_BM']?></td>
                <td><?php echo $hasil['nama_satuan']   ?></td>
                <td><?php 
                        if($hasilBK['Jum_BK']!=0){
                            echo $hasilBK['Jum_BK'];  
                        }else{
                            echo "0";
                        }
                    
                    ?> 
                </td>
                <td><?php echo $hasil['nama_satuan'] ?></td>
				<td><?php echo $hasilBM['Jum_BM']-$hasilBK['Jum_BK'] ?></td>
                <td><?php echo $hasil['nama_satuan'] ?></td>
				
				<td></td>
			</tr>
            <?php }?>
		
		</table>
        </div>
    </div>
    
    <?php }?>


<!-- endContainerFluid -->
</div>

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
