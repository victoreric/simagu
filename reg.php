<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Affairs</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="vendor/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<?php include 'link.php'; ?>
<!-- <body class="bg-gradient-primary"> -->
<body background="vendor/img/butterfly-bg.jpg">
    <div class="row container-fluid">
        <!--firstCol  -->
        <div class="col-sm-4"></div>
        <!-- secondCol -->
        <div class="col-sm-4">
            <div class="card my-5">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap :</label>
                            <input type="text" class="form-control" id='nama' name='nama' placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control " name="username" id='username' placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password untuk login</label>
                                <input type="password" class="form-control" name='pass' id='pass' placeholder="" required>
                        </div>
                    
                        <div class="col"><button type="submit" name="simpan" class="btn btn-primary btn-user btn-block">Daftar Akun </button></div>

                        <div class="col mt-2"><button type="reset" name="reset" class="btn btn-warning btn-user">Reset</button></div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="index.php">Sudah Punya Akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ThirdCol -->
        <div class="col-sm-4"></div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="vendor/js/sb-admin-2.min.js"></script>

</body>
</html>

<!-- login proses -->
<?php
include 'link.php';
if (isset($_POST['simpan'])) {
    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $pass=MD5($_POST['pass']);
   
    $query="INSERT INTO login (nama,username,password) VALUES ('$nama','$username','$pass')";
    $sql=mysqli_query($conn,$query);


    if($sql){
        echo "<script> alert ('Berhasil menambahkan akun baru!'); window.location='index.php'; </script>" ;
    }else {
        echo "terjadi kesalahan selama penyimpanan";
    }
}



?>