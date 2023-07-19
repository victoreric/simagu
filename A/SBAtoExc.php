<?php 
include '../assets/fungsi.php';
include '../assets/indohari.php';
?>
<div>

<div class="container-fluid">
<?php 
    // fungsi header dengan mengirimkan raw data excel
        header('Content-type: application/vnd-ms-excel');      
    // membuat nama file ekspor "data-anggota.xlsl"
        header('Content-Disposition: attachment; filename=StokOpnameFatek.xls');    
    // data source
    include '../link.php'; 
    $tahun_now=$_GET['thn'];
    // echo $thn;
    ?>

<table border='0'>
   <tr>
        <th colspan='8'>DAFTAR STOCK OPNAME </th>
    </tr>
    <tr>
        <th colspan="8">BARANG PERSEDIAAN FAKULTAS TEKNIK UNPATTI</th>
    </tr>
    <tr>
        <th colspan="8">Periode 01 Januari <?php echo $tahun_now ?> s.d. <?php $tgl=date('Y-m-d'); echo tanggal_indo($tgl);?></th>
    </tr>
    <tr>
        <th></th>
    </tr>
</table>

<table border='1'>

    <tr bgcolor="#e5e5e5">
        <th scope="col" colspan="1" class="align-middle">No.</th>
        <th scope="col" colspan="1" class="align-middle">Nama Barang</th>
        <th scope="col" colspan="2" class="align-middle"> Volume masuk</th>
        <th scope="col" colspan="2" class="align-middle">Volume keluar</th>
        <th scope="col" colspan="2" class="align-middle"> Sisa Barang (Stok Opname) </th>
    </tr>

    <!-- isi tabel -->
    <?php
     
		$no=0;
         $query="SELECT DISTINCT barang_masuk.kode_barang, barang.nama_barang, satuan_barang.nama_satuan 
         FROM barang_masuk
         LEFT JOIN barang ON barang.kode_barang=barang_masuk.kode_barang 
         LEFT JOIN satuan_barang ON satuan_barang.id_satuan=barang_masuk.id_satuan_barang
         ORDER BY nama_barang ASC";
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
                    
				<td border='0'><?php  echo $hasilBM['Jum_BM']?></td>
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
			</tr>
            <?php }?>

</table>
</div>