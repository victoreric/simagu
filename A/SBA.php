<?php include 'menuA.php';
include '../link.php';?>

<?php $tahun_now=date('Y'); ?>
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Daftar Stok Opname</a></li>
  </ul>
</div>
<div class="container-fluid"> 
<div class="card mb-5">
  <div class="card-header bg-dark text-white text-center h6"> Daftar Stok Opname<br>
  Barang Persediaan Fakultas Teknik Unpatti <br>
    Tahun Berjalan <br>
  Periode 01 Januari <?php echo $tahun_now ?> s.d. <?php $tgl=date('Y-m-d'); echo tanggal_indo($tgl);?>

  </div>
  <div class="card-body table-responsive">

  <a href="SBAtoExc?thn=<?php echo $tahun_now; ?>" class="btn btn-info mb-2" role="button">Export to Excel</a>

  <table id="example1" class="table table-bordered table-hover table-responsive-justify">
		<thead>
			<tr class="bg-dark text-center text-white">
				<th>No.</th>
                <th> Nama Barang</th>
                <th > Volume masuk</th>
                <th > Volume keluar</th>
                <th > Sisa Barang (Stok Opname) </th>
                <!-- <th > Satuan Barang</th> -->
			</tr>
		</thead>
		<?php
     
		$no=0;
         $query="SELECT DISTINCT barang_masuk.kode_barang, barang.nama_barang, satuan_barang.nama_satuan 
         FROM barang_masuk
         LEFT JOIN barang ON barang.kode_barang=barang_masuk.kode_barang 
         LEFT JOIN satuan_barang ON satuan_barang.id_satuan=barang_masuk.id_satuan_barang
         ";
		$sql = mysqli_query($conn,$query);
		while($hasil=mysqli_fetch_array($sql)){
            $cek1=$hasil['kode_barang'];
            
        // volume barang masuk
        $queriBM="SELECT sum(jumlah) AS Jum_BM
        FROM barang_masuk
        WHERE kode_barang='$cek1' AND  tanggal_bm LIKE '$tahun_now%'  ";
        $sqlBM=mysqli_query($conn,$queriBM);
        $hasilBM=mysqli_fetch_assoc($sqlBM);

         // volume barang keluar
         $queriBK="SELECT sum(jumlah) AS Jum_BK
         FROM barang_keluar
         WHERE kode_barang='$cek1' AND  tanggal_bk LIKE '$tahun_now%' ";
         $sqlBK=mysqli_query($conn,$queriBK);
         $hasilBK=mysqli_fetch_assoc($sqlBK);

            //isi di tabel
          $no++;
        ?>
			<tr>
				<td> <?php echo $no;  ?></td>
				<td><?php echo $hasil['nama_barang']; ?></td>
                    
				<td align="center"><?php  echo $hasilBM['Jum_BM']. " ". $hasil['nama_satuan']?></td>
            
                <td align="center"><?php 
                        if($hasilBK['Jum_BK']!=0){
                            echo $hasilBK['Jum_BK']. " ". $hasil['nama_satuan'] ;  
                        }else{
                            echo "0";
                        }
                    
                    ?> 
                </td>
                
				<td align="center"> <?php echo $hasilBM['Jum_BM']-$hasilBK['Jum_BK']. " ". $hasil['nama_satuan'] ?></td>
        <!-- <td><?php echo $hasil['nama_satuan'] ?></td> -->
			</tr>
            <?php }?>
		
		</table>
  </div>
</div>
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



