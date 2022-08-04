<?php
include 'menuA.php';
?>

<!-- Main content starts -->
<div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
  </ul>
</div>

<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Umum</h6>
        </div>
        <div class="card-body" style="color:black">
            <p><b>Selamat datang</b> di Aplikasi Electronic Monitoring dan Evaluasi (e-Monev) Gereja Protestan Maluku.</p>
            <p class="text-justify">Aplikasi e-Monev dibuat untuk memenuhi kebutuhan pelaksanaan evaluasi dan monitoring kegiatan-kegiatan dalam lingkungan Gereja Protestan Maluku.
            </p>
            <p class="mb-0 text-justify">Aplikasi ini masih dalam tahap pengembangan, sehingga dibutuhkan saran dan kritik yang dapat digunakan untuk perbaikan aplikasi di waktu mendatang</p>
        </div>
    </div>

    <!-- Statistik  -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Total Kegiatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">10
                        <small>kegiatan </small>
                        <p class="text-xs bg-secondary text-white">yang direncanakan</p>
                    </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-envelope-open-o fa-2x text-gray-30"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Realisasi Kegiatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">4
                        <small>Kegiatan</small>
                        <p class="text-xs bg-primary text-white">Lebih Target</p>
                    </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-envelope-open fa-2x text-gray-30"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Realisasi Kegiatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">3
                        <small>Kegiatan</small>
                        <p class="text-xs bg-success text-white">Sesuai Target</p>
                    </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-envelope-o fa-2x text-gray-30"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Kegiatan Tidak Terealisasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">3
                        <small>Kegiatan</small>
                        <p class="text-xs bg-danger text-white">Nihil Target</p>
                    </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-envelope fa-2x text-gray-30"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- endStatistik  -->

<!-- endContainerFluid -->
</div>


<?php
include '../footer.php';
?>
