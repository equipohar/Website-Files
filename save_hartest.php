<?php
//echo "welcome";
  if(!empty($_GET['value_x']) && !empty($_GET['value_y']) && !empty($_GET['value_z']) && !empty($_GET['idPersonal'])){
    if(isset($_GET['value_x']) && isset($_GET['value_y']) && isset($_GET['value_z']) && isset($_GET['idPersonal'])){
	 include 'includes/configuracion_har.php';
	 if($mysqli){
	  $x = json_decode($_GET['value_x']);
	  $y = json_decode($_GET['value_y']);
	  $z = json_decode($_GET['value_z']);
	 
	  for ($i = 0 ; $i < sizeof($x); $i++){
	  	echo $x[$i];
	  	echo $y[$i];
	  	echo $z[$i];

	  	date_default_timezone_set('America/Bogota');
	    $sentencia = "INSERT INTO testing_data (value_x,value_y,value_z,idPersonal,tiempo) VALUES(".$x[$i].",".$y[$i].",".$z[$i].",".$_GET["idPersonal"].",CURRENT_TIMESTAMP)";
	    mysqli_query($mysqli,"SET time_zone = '-05:00'"); 
	    $res = mysqli_query($mysqli,$sentencia);
	    if($res){echo "llegó";}else{echo "nada";}
	  }



	  }
	 else {echo "no connect";}
	}

    }
?>
