<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Registrasi</title>

    <!-- Bootstrap CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
    <div class="wrapper">

        <!-- Page Content  -->
        <div id="content">

        <?php
        //Include file koneksi, untuk koneksikan ke database
        include "admin/koneksi.php";
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nim=input($_POST["nim"]);
            $nama=input($_POST["nama"]);
            $jeniskelamin=input($_POST["jenis_kelamin"]);
            $tanggalLahir=input($_POST["tgl_lahir"]);
            $alamat=input($_POST["alamat"]);
            $agama=input($_POST["agama"]);
            $email=input($_POST["email"]);
            $no_hp=input($_POST["no_hp"]);
            $nama_ortu=input($_POST["nama_ortu"]);
            $nohp_ortu=input($_POST["nohp_ortu"]);
            $jurusan=input($_POST["jurusan"]);
            $foto=input($_POST["foto"]);
            $foto = upload();
            if(!$foto){
                return false; //apabila gagal upload maka berhenti
            }
            //Query input menginput data kedalam tabel mhs
            $sql="insert into mhs (nim,nama,jenis_kelamin,tgl_lahir,alamat,agama,email,no_hp,nama_ortu,nohp_ortu,jurusan,foto) values
            ('$nim','$nama','$jeniskelamin','$tanggalLahir','$alamat','$agama','$email','$no_hp','$nama_ortu','$nohp_ortu','$jurusan','$foto')";
            //Mengeksekusi/menjalankan query diatas
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:home.html");
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
        
        
            move_uploaded_file($tmpName,'admin/foto_mhs/'. $namaFileBaru);
            return $namaFileBaru;
        }

        
    
        ?>


        <h2>Registrasi Data</h2>

            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">

                <div class="form-group col-form-label-lg">
                    <label for="">NIM :</label>
                    <input type="text" name="nim" class="form-control" placeholder="Masukan nim" required />
                </div>

                <div class="form-group col-form-label-lg">
                    <label for="">Nama Lengkap :</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required />
                </div>
                
                <div class="form-group col-form-label-lg form-row">
                    <div class="form-group col-md-6">
                        <label for="">Tempat Lahir :</label>
                        <input type="text" class="form-control" name="tmp_lahir" placeholder="Masukan tempat lahir" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Tanggal Lahir :</label>
                        <input type="date" class="form-control" name="tgl_lahir">
                    </div>
                </div>
 
                <div class="form-group col-form-label-lg">
                    <label for="">Alamat :</label>
                    <textarea name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
                </div>

                <div class="form-group col-form-label-lg">
                    <label for="">Jenis Kelamin :</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" required/> <label>Laki-laki</label>
                        <br>
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" required/> <label>Perempuan</label>
                    </div>
                </div>  
        
                <div class="form-group col-form-label-lg">
                    <label for="">Agama :</label>
                    <select name="agama" class="form-control">
                        <option value="--" selected>--</option>
                        <option value="Islam">Islam</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Kong Hu Chu">Kong Hu Chu</option>
                    </select>
                </div> 

                <div class="form-group col-form-label-lg">
                    <label for="">E-mail :</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukan Email" required/>
                </div>
                        
                <div class="form-group col-form-label-lg">
                    <label for="">No HP :</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
                </div>
                <div class="form-group col-form-label-lg">
                    <label for="">Nama Orang tua / Wali</label>
                    <input type="text" name="nama_ortu" class="form-control" placeholder="Masukan Nama Orang Tua / Wali" required/>
                </div>
                <div class="form-group col-form-label-lg">
                    <label for="">No HP Orang Tua / Wali</label>
                    <input type="text" name="nohp_ortu" class="form-control" placeholder="Masukan No HP Orang Tua / Wali" required/>
                </div>

                <div class="form-group col-form-label-lg">
                    <label for="">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required/>
                </div>

                <div class="form-group col-form-label-lg">
                    <label for="">Upload Foto</label>
                    <input type="file" class="form-control-file" name="foto">
                </div>
            
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-">Submit</button>
                <a href="landingPage.html" class="btn btn-lg btn-primary" role="button">Back</a>
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