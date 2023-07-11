<?php
include '../assets/fungsi.php';
include '../assets/indohari.php';

session_start();
if(!isset($_SESSION['nama'])){
   echo "<script> alert('Anda Belum Login'); window.location='../index'; </script>";
} 

$level=$_SESSION['level'];
if($level=='1'){
    ?>
    <!-- MenuForAdmin -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Simagu v.1">
        <meta name="author" content="Victor Pattiradjawane">
        <title>Sistem Manajemen Gudang</title>

         <!-- css untuk select2 -->
         <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- jika menggunakan bootstrap4 gunakan css ini  -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


        <!-- Custom styles for this template-->
        <link href="../vendor/css/sb-admin-2.css" rel="stylesheet">

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="../vendor/jquery/jquery.min.js"></script>

        <!-- scriptJamDigital -->
        <script type="text/javascript">
            // 1 detik = 1000
            window.setTimeout("waktu()",1000);
            function waktu() {
            var tanggal = new Date();
            setTimeout("waktu()",1000);
            document.getElementById("tanggalku").innerHTML
            = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
            }
        </script>

        <!-- forDataTable -->
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .table{
                color:black;
            }    
            .table-hover tbody tr:hover {
                color: black;
                background-color: #a3b6ee;
                /* background-color: rgba(255, 255, 255, 0.075); */
                }        
        </style>
       

    
    </head>
    <body id="page-top" onload="waktu()">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
          
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                    <div class="sidebar-brand-icon">
                        <!-- <i class="fas fa-laugh-wink"></i> -->
                        <img src="../assets/img/unpattilogo.png" width="70px" alt="">
                    </div>
                    <div class="sidebar-brand-text mx-3">Fakultas Teknik Unpatti<sup></sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <hr class="sidebar-divider">

                 <!-- Heading -->
                 <!-- <div class="sidebar-heading">
                    Laporan
                </div> -->
                <!-- Nav Item - statistik Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Laporan berdasarkan:</h6> -->
                            <a class="collapse-item" href="SBA">Stok Barang Terakhir</a>
                            <!-- <a class="collapse-item" href="SBT">Stok Barang Per Tanggal</a> -->
                            <a class="collapse-item" href="SBB">Stok Barang Per Bulan</a>
                        </div>
                    </div>
                </li>

                 <!-- Divider -->
                 <hr class="sidebar-divider">

                 <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Pencatatan</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Input berdasarkan:</h6> -->
                            <a class="collapse-item" href="BM">Barang Masuk</a>
                            <a class="collapse-item" href="BK">Barang Keluar</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                    Master Data
                </div> -->
                <!-- Nav Item - statistik Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <i class="fa fa-th-list fa-chart-area"></i>
                        <span>Master Data</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Master data:</h6> -->
                            <a class="collapse-item" href="kategori">Kategori</a>
                            <a class="collapse-item" href="merek">Merek</a>
                            <a class="collapse-item" href="barang">Barang</a>
                            <a class="collapse-item" href="satuan">Satuan</a>
                            <a class="collapse-item" href="mu">Manajemen User</a>
                        </div>
                    </div>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <li class="nav-item">
                    <span class="nav-link collapsed" aria-expanded="true" aria-controls="collapseThree">
                        <span>
                        <?php 
                            date_default_timezone_set('Asia/Jayapura');
                            $hari=date('D');
                            echo hari_ini($hari).',';
                            echo '<br>';
                            $tgl=date('Y-m-d');
                            echo tanggal_indo($tgl);
                            echo '<br>';
                        ?>
                            <table align=center style="border:0px solid black" bgcolor="" cellpadding="7">
                                <tr>
                                    <td><div id="tanggalku"></div> </td>
                                </tr>
                            </table>
                        </span>
                    </span>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                       
                    </div>
                <!-- endMyMenu -->
            </ul>
            <!-- End of Sidebar -->


            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

            <!-- Top NavBar -->
                <div id="topNavBar">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-1 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-warning btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    <h6 class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 text-white">SIMAGU </h6>
                    
                        <!-- Topbar Navbar -->
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <ul class='navbar-nav text-white'>
                            <li class="nav-item no-arrow d-sm-none">SIMAGU  <sup></sup></li>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>
                        
                            <?php
                            // include '../link.php';
                            // $nama=$_SESSION['nama'];
                            // $queriU="SELECT foto FROM dtawal WHERE nama='$nama'";
                            // $sqlU=mysqli_query($conn,$queriU);
                            // $hasilU=mysqli_fetch_assoc($sqlU);
                            // $cek=mysqli_num_rows($sqlU);
                            ?>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-white-500"><?php echo $_SESSION['nama'];  ?></span>
                                   
                                    <img class='img-profile rounded-circle' src='../vendor/img/undraw_profile.svg'>
                                    
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                            
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Ganti Password
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Keluar
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
    <!-- end  Topbar Navbar-->

    <?php } 
    else {
        echo "<script> alert('Anda Tidak punya akses ke Halaman ini.'); window.location='../index'; </script>";
        exit;
    }
    ?>