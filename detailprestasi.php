<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Berita</title>
    <link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=ABeeZee&display=swap/" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="detailprestasi.css">

</head>
<body>
<header>
    <nav class="navbar navbar-expand-sm bg-light">
            <a class="navbar-brand navbar-left" href="#">
                <img src="assets/img/fpmipa.png" alt="" style="width: 150px; height: 50px;">
            </a>
            <ul class="navbar-nav navbar-right ml-auto" id="nav">
				<li class="nav-item">
                    <a href="home.html" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="about.html" class="nav-link">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a href="dosen.html" class="nav-link">DOSEN</a>
                </li>
                <li class="nav-item">
                    <a href="berita.php" class="nav-link">BERITA</a>
                </li>
                <li class="nav-item">
                    <a href="prestasi.php" class="nav-link">PRESTASI</a>
                </li>
                <form class="form-inline" action="/action_page.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>
            </ul>
    </nav>
</header>

<main>
	<?php

	include "koneksi.php";
	//Fungsi untuk mencegah inputan karakter yang tidak sesuai
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		
		return $data;
	}
	if (isset($_GET['id'])) {
		$id=input($_GET["id"]);
		$sql="select * from berita where id=$id";
		$hasil=mysqli_query($kon,$sql);
		$data = mysqli_fetch_assoc($hasil);
	}
	?>

	<div class="kotak">
		<div>
			<h3 class="text1">
				<b><?php echo $data["judul"];   ?></b>
			</h3>
			<p class="text2">
				By
				<a href="#">Admin WEB</a>
				FPMIPA UPI	
			<p>
			<img src = "admin/berita/foto_berita/<?= $data["foto"]; ?>" width="60%" class="img">
		</div>
		
		<div class="text">
			<article><?php echo $data["isi"];   ?></article>
		</div>

		<section class="pt-3 pb-3">
	        <div class="container">
	            <div class="row">
	                <div class="col-6">
	                    <h3 class="mb-3"></h3>
	                </div>
	                <div class="col-6 text-right">
	                    <a class="btn btn-white mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
	                        <i class="fa fa-arrow-left"></i>
	                    </a>
	                    <a class="btn btn-white mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
	                        <i class="fa fa-arrow-right"></i>
	                    </a>
	                </div>

	                <div class="col-12">
	                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

	                        <div class="carousel-inner">
	                            <div class="carousel-item active">
	                                <div class="row">

										<?php
											include "koneksi.php";
											$sql="select * from berita order by id desc";
									
											$hasil=mysqli_query($kon,$sql);
											$no=0;
											while ($data = mysqli_fetch_array($hasil)) {
												$no++;
									
												if ($no % 3 === 0){
													?>
													<div class="carousel-item">
	                                					<div class="row">
															<div class="col-md-4 mb-3">
																<div class="card">
																	<img class="img-fluid" src = "admin/berita/foto_berita/<?= $data["foto"]; ?>" width="550">
																	<div class="card-body">
																		<h4 class="card-title"><?php echo $data["judul"];   ?></h4>
																		<p class="card-text"><?php echo substr($data['isi'], 0, 50);?></p>
																		<a href="detailberita.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-info" role="button">Detail</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<?php
												}else{
													?>
													<div class="col-md-4 mb-3">
													<div class="card">
														<img class="img-fluid" src = "admin/berita/foto_berita/<?= $data["foto"]; ?>" width="550">
														<div class="card-body">
															<h4 class="card-title"><?php echo $data["judul"];   ?></h4>
															<p class="card-text"><?php echo substr($data['isi'], 0, 50);?></p>
															<a href="detailberita.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-info" role="button">Detail</a>
														</div>
													</div>
												</div>
												<?php
												}
												?>
											<?php
											}
										?>
	                                </div>
	                            </div>
							</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>
	</div>

</main>

<footer class="page-footer font-small blue pt-4">
    <!-- Grid container -->
    <div class="container-fluid text-center text-md-left">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
<!--                <h5 class="text-uppercase">Contact Us</h5>-->
                <img src="assets/img/fpmipa.png" alt="" style="width: 150px; height: 50px;">
                <p>
                    Universitas Pendidikan Indonesia, Bumi Siliwangi <br>
                    Jl. Dr. Setiabudi No.229, Isola, Kec. Sukasari, Kota Bandung, Jawa Barat 40154
                </p>
            </div>
            <!--Grid column-->
            <hr class="clearfix w-100 d-md-none pb-3">
            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h7>Contact Us :</h7>
                <ul class="list-unstyled mb-0">
                    <li class="container list">
                        <span class="iconify" class="text-dark" data-icon="bi:clock-history" data-inline="false"></span>
                        <a href="#!" class="text-dark">Senin - Jumat: 08:00 -15:00</a>
                    </li>
                    <li class="container list">
                        <span class="iconify" data-icon="bi:whatsapp" data-inline="false"></span>
                        <a href="#!" class="text-dark">081234567891</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5><br></h5>
                <ul class="list-unstyled mb-0">
                    <li class="container list">
                        <span class="iconify" data-icon="bx:bx-phone-call" data-inline="false"></span>
                        <a href="#!" class="align-middle">081234567891</a>
                    </li>
                    <li class="container list">
                        <span class="iconify" data-icon="carbon:email-new" data-inline="false"></span>
                        <a href="#!" class="text-dark">fpmipa@upi.edu</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0"><br></h5>

                <ul class="list-unstyled">
                    <li class="container list">
                        <span class="iconify" data-icon="feather:facebook" data-inline="false"></span>
                        <a href="#!" class="text-dark">FPMIPA UPI</a>
                    </li>
                    <li class="container list">
                        <span class="iconify" data-icon="line-md:twitter" data-inline="false"></span>
                        <a href="#!" class="text-dark">FPMIPA UPI</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->
</footer>
<!-- Footer -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>