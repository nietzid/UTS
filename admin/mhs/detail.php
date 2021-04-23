<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

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
                    <a href="#">Data Mahasiswa</a>
                </li>
                <li>
                    <a href="#">Data Berita</a>
                </li>
                <li>
                    <a href="#">Data Prestasi</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
    <?php

        include "koneksi.php";
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }
        if (isset($_GET['nim'])) {
            $nim=input($_GET["nim"]);
            $sql="select * from mhs where nim=$nim";
            $hasil=mysqli_query($kon,$sql);
            $data = mysqli_fetch_assoc($hasil);
        }
    ?>


        <table class="table table-hover table-dark">
            <tr>
                <td>Nim</td>
                <td>:</td>
                <td><?php echo $data["nim"];   ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $data["nama"];   ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo $data["jenis_kelamin"];   ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><?php echo $data["tgl_lahir"];   ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $data["alamat"];   ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?php echo $data["agama"];   ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td>:</td>
                <td><?php echo $data["email"];   ?></td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td><?php echo $data["no_hp"];   ?></td>
            </tr>
            <tr>
                <td>Nama Orang Tua/Wali</td>
                <td>:</td>
                <td><?php echo $data["nama_ortu"];   ?></td>
            </tr>
            <tr>
                <td>No HP Orang Tua/Wali</td>
                <td>:</td>
                <td><?php echo $data["nohp_ortu"];   ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?php echo $data["jurusan"];   ?></td>
            </tr>
            <tr>
                <td>foto</td>
                <td>:</td>
                <td><img src = "foto_mhs/<?= $data["foto"]; ?>" width="150"></td>
            </tr>
        </table>

        <a href="update.php?nim=<?php echo htmlspecialchars($data['nim']); ?>" class="btn btn-warning" role="button">Update</a>
        <a href="index.php" class="btn btn-primary" role="button">Back</a>
        

        <br><br>

    </div>
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