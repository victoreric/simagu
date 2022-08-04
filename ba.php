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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="vendor/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-5 p-3"> <img src="assets/img/bg-student-affairs.jpg" alt="login" class="col-lg-12 d-none d-lg-block">  </div> 
                    <div class="col-lg-6">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                            </div>
                            <!-- <form class="user"> -->
                            <form method="POST" action="" enctype="multipart/form-data"> 	
                            <div class="form-group">
                                <label for="nim">NIM :</label>
                                    <input type="number" min="1" class="form-control" id='nim' name='nim' placeholder="NIM" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control " name="nama" id='nama' placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="prodi">Program Studi</label>
                                    <select name="prodi" class="form-control" id='prodi' required>
                                        <option value=''> --Pilih Program Studi-- </option>
                                        <option> Teknik Perkapalan </option>
                                        <option> Teknik Mesin  </option>
                                        <option> Teknik Sistem Perkapalan </option>
                                        <option> Teknik Industri </option>
                                        <option> Teknik Sipil </option>
                                        <option> Perencanaan Wilayah dan Kota </option>
                                        <option> Teknik Transportasi Laut </option>
                                        <option> Teknik Perminyakan </option>
                                        <option> Teknik Goelogi </option>
                                        <option> Teknik Geofisika </option>
                                        <option> Teknik Kimia </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <Label for='email'>Email:</Label>
                                    <input type="email" class="form-control" name='email' id='email' placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                        <input type="password" class="form-control"
                                            name='pass' id='pass' placeholder="Password" required>
                                </div>

                                <div class="col"><button type="submit" name="simpan" class="btn btn-primary btn-user btn-block">Daftar Akun </button></div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index">Sudah Punya Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    $nim=$_POST['nim'];
    $nama=$_POST['nama'];
    $prodi=$_POST['prodi'];
    $email=$_POST['email'];
    $pass=MD5($_POST['pass']);

    $query="INSERT INTO login (nim,nama,prodi,email,pass) VALUES ('$nim','$nama','$prodi','$email','$pass')";
    $sql=mysqli_query($conn,$query);


    if($sql){
        echo "<script> alert ('Berhasil menambahkan akun baru!'); window.location='index'; </script>" ;
    }else {
        echo "terjadi kesalahan selama penyimpanan";
    }
}
?>