<?php
//echo "welcome";
  if(!empty($_GET['value_x']) && !empty($_GET['value_y']) && !empty($_GET['value_z'])){
  echo "primer if";
    if(isset($_GET['value_x']) && isset($_GET['value_y']) && isset($_GET['value_z'])){
    echo "segundo if";
	  include 'includes/configuracion_har.php';
	 if($mysqli){
	echo "aja";
	  date_default_timezone_set('America/Bogota');
	  $sentencia = "INSERT INTO testing_data (value_x,value_y,value_z,tiempo) VALUES(".$_GET['value_x'].",".$_GET['value_y'].",".$_GET['value_z'].",CURRENT_TIMESTAMP)";
	 echo $sentencia;
	  mysqli_query($mysqli,"SET time_zone = '-05:00'"); 
	  $res = mysqli_query($mysqli,$sentencia);
	  if($res){echo "llegó";}else{echo "nada";}
	  }
	 else {echo "no connect";}
	}

    }
?>
