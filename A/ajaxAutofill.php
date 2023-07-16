<?php

//membuat koneksi ke database
include '../link.php';
// $koneksi = mysqli_connect("localhost", "victor", "Rahasia@6174", "gudang_db");

//variabel nim yang dikirimkan form.php
$kode_barang = $_GET['id'];

//mengambil data
$query = " SELECT *, satuan_barang.nama_satuan  
        FROM barang
        LEFT JOIN satuan_barang ON barang.id_satuan_barang=satuan_barang.id_satuan where kode_barang='$kode_barang'";
$sql=mysqli_query($conn,$query);
$barang = mysqli_fetch_array($sql);

// echo print_r($barang)

$data = array(
    // 'nama_barang'      =>  @$barang['nama_barang'],
    // 'kode_kategori'      =>  @$barang['kode_kategori'],
    'kode_merek'   =>  @$barang['nama_satuan'],
    // 'detail_barang'      =>  @$barang['detail_barang'],
    // 'stok_awal'      =>  @$barang['stok_awal'],
    'id_satuan_barang'    =>  $barang['id_satuan_barang'],
  
);


    //tampil data
echo json_encode($data);
?>