<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, 
	initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="HAR/css/estilos.css">
	<link rel="stylesheet" href="HAR/css/font-awesome.min.css">
	<link rel="stylesheet" href="HAR/fonts/style.css">
	<title>TRACK MY MOVEMENT</title>
</head>
<body>
	<div class="contenedor" id="contenedor">
		<section class="tarjeta">
			<div class="slider_banner">
				<div class="banner" id="banner">
					<img class="slide active" src="HAR/img/img1.png" alt="">
					<img class="slide" src="HAR/img/img2.png" alt="">
					<img class="slide" src="HAR/img/img3.png" alt="">
				</div>

				<!-- Flechas del Banner -->
				<a href="#" id="banner-prev" class="flecha-banner anterior"><span class="fa fa-chevron-left"></span></a>
				<a href="#" id="banner-next" class="flecha-banner siguiente"><span class="fa fa-chevron-right"></span></a>
			</div>

			<section class="slider_info">
				<!-- Flechas del Slider -->
				<a href="#" id="info-prev" class="flecha-info anterior" ><span class="fa fa-chevron-left"></span></a>
				<a href="#" id="info-next" class="flecha-info siguiente"><span class="fa fa-chevron-right"></span></a>

				<section class="informacion" id="informacion">
					<article id="info">
						<div class="slide active">
							<h1 class="nombre"></h1>
							<h1 class="nombre2"></h1>
							<p class="trabajo">HUMAN ACTIVITY <br><br> RECOGNITION CLASSIFIER</p>
							<p class="pais"><img src="/HAR/img/bandera.png" alt="">Universidad del Norte, Barranquilla Colombia </p>
						</div>
					
						<div class="slide">
							<h2 class="subtitulo">ABOUT US</h2>
							<p class="texto"><?php $connect = mysqli_connect("localhost", "root", "equipohar123", "testing_har");
												$query = ("SELECT texto FROM informacion WHERE id_texto = 1"); 
												$result = mysqli_query($connect, $query);
												$row = mysqli_fetch_array($result);
												echo $row['texto']; ?></div>

						<div class="slide">
							<h2 class="subtitulo">DO YOU WANT TO TRY SAVITAR?</h2>
							<p class="texto"> Press the button below to check out what "Savitar" is tracking for you.  
							</p>
							  <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
							  <a href = "http://www.track-mymovement.tk/HAR/graficas/lineas/lineas.php" class = "button fa fa-area-chart" >Graphs</a>
							  <?php else: ?>
							  <a class="button fa fa-area-chart" href="/LoginPHP/login.php" >Login</a>
							  <?php endif; ?>
						    

						</div>
					</article>
				</section>

			</section>
			<section class="redes-sociales">
				<a href="https://github.com/equipohar" class="github"><span class="fa fa-github-alt"></span></a>
				<a href="https://www.uninorte.edu.co/" class="university"><span class="fa fa-university"></span></a>

			</section>
		</section>
	</div>

	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
	<script src="/HAR/js/main.js"></script>
</body>
</html>
