<?php
include '../assets/fungsi.php';
include '../assets/indohari.php';
include '../link.php'; 

    // fungsi header dengan mengirimkan raw data excel
        header('Content-type: application/vnd-ms-excel');      
    // membuat nama file ekspor "data-anggota.xlsl"
        header('Content-Disposition: attachment; filename=StokOpnameFatek.xls');    
    // data source
    $tanggal_awal=$_GET['tgl_awal'];
    $tanggal_akhir=$_GET['tgl_akhir'];
    // echo $tgl_awal;

    // mendapatkan tanggal 1 januari dari tahun yang dipilih
    $thn_saja= date("Y", strtotime($tanggal_awal));
    //  echo $thn_saja;
    $tanggal_pertama=$thn_saja.'-01-01';
    // echo $tanggal_pertama;

    // mendapatkan tanggal sehari sebelumnya
        $tanggalsebelumnya=date_create("$tanggal_awal");
        date_modify($tanggalsebelumnya,"-1 days");
        $tsHasil=date_format($tanggalsebelumnya,"Y-m-d");
        // echo $tsHasil;
    // end mendapatkan tanggal sehari sebelumnya
    ?>

<div>

<div class="container-fluid">

<table border='0'>
   <tr>
        <th colspan='10'>DAFTAR STOCK OPNAME </th>
    </tr>
    <tr>
        <th colspan="10">BARANG PERSEDIAAN FAKULTAS TEKNIK UNPATTI</th>
    </tr>
    <tr>
        <th colspan="10">
            Periode <?php echo tanggal_indo($tanggal_awal). "  sampai dengan  " . tanggal_indo($tanggal_akhir) ;?>
        </th>
    </tr>
    <tr>
        <th></th>
    </tr>
</table>

<table border='1'>

    <tr bgcolor="#e5e5e5">
        <th scope="col" colspan="1" class="align-middle">No.</th>
        <th scope="col" colspan="1" class="align-middle">Nama Barang</th>
        <th scope="col" colspan="2" class="align-middle"> Sisa stok bulan lalu </th>
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
     WHERE tanggal_bm BETWEEN '$tanggal_pertama' AND '$tanggal_akhir'
     ";
    $sql = mysqli_query($conn,$query);
    while($hasil=mysqli_fetch_array($sql)){
        $cek1=$hasil['kode_barang'];
        
    // tampil stok sisa bulan sebelumnya
         // volume barang masuk bulan sebelumnya
        $queriBMLast="SELECT sum(jumlah) AS Jum_BM
        FROM barang_masuk
        WHERE kode_barang='$cek1' AND  tanggal_bm BETWEEN '$tanggal_pertama' AND '$tsHasil'";
        $sqlBMLast=mysqli_query($conn,$queriBMLast);
        $hasilBMLast=mysqli_fetch_assoc($sqlBMLast);

        // volume barang keluar bulan sebelumnya
        $queriBKLast="SELECT sum(jumlah) AS Jum_BK
        FROM barang_keluar
        WHERE kode_barang='$cek1' AND  tanggal_bk BETWEEN '$tanggal_pertama' AND '$tsHasil'";
        $sqlBKLast=mysqli_query($conn,$queriBKLast);
        $hasilBKLast=mysqli_fetch_assoc($sqlBKLast);

    // end tampil stok sisa bulan sebelumnya


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

            <td><?php  echo $hasilBMLast['Jum_BM']-$hasilBKLast['Jum_BK'];?></td>
            <td><?php echo $hasil['nama_satuan'] ?></td>
            
            <td><?php  
                if($hasilBM['Jum_BM']!=0){
                    echo $hasilBM['Jum_BM'];  
                }else{
                    echo "0";
                } ?>
            </td>
            <td><?php echo $hasil['nama_satuan']?></td>
            <td><?php 
                    if($hasilBK['Jum_BK']!=0){
                        echo $hasilBK['Jum_BK'];  
                    }else{
                        echo "0";
                    }
                ?> 
            </td>
            <td><?php echo $hasil['nama_satuan'] ?></td>
            <td><?php echo (($hasilBMLast['Jum_BM']-$hasilBKLast['Jum_BK'])+ $hasilBM['Jum_BM'])-$hasilBK['Jum_BK'] ?></td>
            <td><?php echo $hasil['nama_satuan'] ?></td>
        </tr>
        <?php }?>

</table>
</div>