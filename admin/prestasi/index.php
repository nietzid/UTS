<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Data</title>

    <!-- Bootstrap CSS CDN -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/sidebar.css">
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

            include "koneksi.php";         

            //Cek apakah ada nilai dari method GET dengan nama id_anggota
            if (isset($_GET['id'])) {
                $id=htmlspecialchars($_GET["id"]);
                $sql="delete from prestasi where id='$id'";
                
                $hasil=mysqli_query($kon,$sql);

                //Kondisi apakah berhasil atau tidak
                    if ($hasil) {
                        header("Location:index.php");

                    }
                    else {
                        echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

                    }
                }
            ?>
            
            <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
            
            <br><br>
            <table class="table table-bordered table-hover table-dark">
                <br>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Foto</th>
                    <th colspan="3">Aksi</th>
                </tr>
                </thead>
                <?php
                include "koneksi.php";
                $sql="select * from prestasi order by id desc";
        
                $hasil=mysqli_query($kon,$sql);
                $no=0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
        
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $data["judul"];   ?></td>
                        <td><?php echo $data["isi"];   ?></td>
                        <td><img src = "foto_prestasi/<?= $data["foto"]; ?>" width="150"></td>
                        <td>
                            <a href="detail.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-info" role="button">Detail</a>
                            <br><br>
                            <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a> 
                            <br><br>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                }
                ?>
            </table>
            
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