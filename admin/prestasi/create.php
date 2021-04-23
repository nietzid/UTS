<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Input</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/sidebar.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
    <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Halaman Admin</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>List data</p>
                    <li class="active">
                        <a href="../mhs/index.php">Data Mahasiswa</a>
                    </li>
                    <li>
                        <a href="../berita/index.php">Data Berita</a>
                    </li>
                    <li>
                        <a href="index.php">Data Prestasi</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">

        <?php
        //Include file koneksi, untuk koneksikan ke database
        include "koneksi.php";
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $judul=input($_POST["judul"]);
            $isi=input($_POST["isi"]);
            $foto=input($_POST["foto"]);
            $foto = upload();
            if(!$foto){
                return false; //apabila gagal upload maka berhenti
            }
            //Query input menginput data kedalam tabel mhs
            $sql="insert into prestasi (judul,isi,foto) values
            ('$judul','$isi','$foto')";
            //Mengeksekusi/menjalankan query diatas
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:index.php");
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }

            
        }

        function upload(){
            $namaFile = $_FILES['foto']['name'];
            $ukuranFile = $_FILES['foto']['size'];
            $error = $_FILES['foto']['error'];
            $tmpName = $_FILES['foto']['tmp_name'];
            //cek apakah tidak ada foto/file yang diupload
            if($error === 4){
                echo "<script> alert('harap upload foto terlebih dahulu')</script>";
                return false;
            }
            //membatasi jenis file yang diupload
            $ekstenFileValid = ['jpg','jpeg','png'];
            $ekstenFile = explode('.',$namaFile);
            $ekstenFile = strtolower(end($ekstenFile));
        
            if(!in_array($ekstenFile,$ekstenFileValid)){
                echo "<script> alert('Harap masukan file berupa jpg,jpeg, dan png!')</script>";
                return false;
            }

            //set batas maks size gambar
            if( $ukuranFile > 5000000){
                echo "<script> alert('Ukuran gambar terlalu besar!')</script>";
                return false;
            }

            //generate nama baru, agar tidak ada file memiliki nama yang sama dan tidak saling menimpa 
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstenFile;
        
        
            move_uploaded_file($tmpName,'foto_prestasi/'. $namaFileBaru);
            return $namaFileBaru;
        }

        
    
        ?>


        <h2>Input Data</h2>

            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">

                <div class="form-group col-form-label-lg">
                    <label for="">Judul :</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukan nim" required />
                </div>
                <div class="form-group col-form-label-lg">
                    <label for="">Isi :</label>
                    <textarea name="isi" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
                </div>

                <div class="form-group col-form-label-lg">
                    <label for="">Upload Foto</label>
                    <input type="file" class="form-control-file" name="foto">
                </div>
            
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-">Submit</button>
                <a href="index.php" class="btn btn-lg btn-primary" role="button">Back</a>
            </form>
        
            <br><br>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>