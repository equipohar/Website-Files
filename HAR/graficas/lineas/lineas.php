<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<link rel="stylesheet" href="../libs/morris.css">
		<script src="../libs/morris.min.js" charset="utf-8"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <title>GRAPHS</title>
        <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        body{
            background: linear-gradient(to bottom, #ccffcc 5%, #99ccff 100%)
        }

        ul {
        position: fixed;
        top: 0;
        width: 100%;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li {
        border-right: 1px solid #bbb;
        }

        li:last-child {
            border-right: none;
        }

        li a:hover {
            background-color: #111;
        }

        .active {
        background-color: #4CAF50;
        }
        </style>
    </head>

    <body>
      <ul>
      <li><a href="http://track-mymovement.tk/index.php">Home</a></li>
      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
      <li style="float: right"><a href="http://track-mymovement.tk/LoginPHP/logout.php">Logout</a></li>
      <?php else: ?>
      <li style="float: right"><a href="http://track-mymovement.tk/LoginPHP/login.php">Login</a></li>
      <?php endif; ?>
    </ul>
    <br>
    <br>

        <div class= "container">
        	<h1 style = "text-align: center">Accelerometer Graphs</h1>
		    <br> 
                                <h2>Hey <?php echo $_SESSION['username']?> , you are: <?php
		                            $connect = mysqli_connect("localhost", "root", "equipohar123", "testing_har");
                                    $email = $_SESSION['email'];
									$query = ("SELECT * FROM testing_data WHERE labelRF IS NOT NULL AND idPersonal = '$email' ORDER BY id DESC LIMIT 1");
									$result = mysqli_query($connect, $query);
									$row = mysqli_fetch_array($result);
									$label = $row['labelRF'];
									$query2 = ("SELECT * FROM labels WHERE id_label = $label");
 									$result2 = mysqli_query($connect, $query2);
 									$row2 = mysqli_fetch_array($result2);
									$activity = $row2['tipo_label'];
									echo $activity; ?>  
								</h2>
				<hr>
        	<h2>x, y , z vs. time</h2>
        	<div id="lineas"></div>
        		<hr>
    		<h2>activity vs. time</h2>
        	<div id="areas"></div>


        </div>

    </body>
</html>


<?php 
$connect = mysqli_connect("localhost", "root", "equipohar123", "testing_har");
$query = "SELECT value_x, value_y, value_z, tipo_label, labelKNN, tiempo FROM testing_data, labels WHERE labelKNN IS NOT NULL AND id_label=labelKNN AND idPersonal = '$email' ORDER BY id DESC LIMIT 100";
$result = mysqli_query($connect, $query);
$chart_data = '';
$chart_data2 = '';
while($row = mysqli_fetch_array($result))
{
$chart_data .= "{ tiempo:'".$row["tiempo"]."', value_x:".$row["value_x"].", value_y:".$row["value_y"].", value_z:".$row["value_z"]."}, ";
$chart_data2 .= "{ tiempo:'".$row["tiempo"]."', label:".$row['labelKNN']."}, ";
}
$chart_data = substr($chart_data, 0, -2);
$chart_data2= substr($chart_data2, 0, -2);
?>


<script>
Morris.Line({
 element : 'lineas',
 data:[<?php echo $chart_data; ?>],
 xkey:'tiempo',
 ykeys:['value_x', 'value_y', 'value_z'],
 labels:['x', 'y', 'z'],
 hideHover:'auto',
 stacked:true,
 resize: true,
 lineColors: ['#885FF4', '#F64858', '#1BE71B'], 
 continuosLine: true,
 gridTextColor: '#171714',
 pointSize: 1, 
});
</script>


<script>
Morris.Line({
 element : 'areas',
 data:[<?php echo $chart_data2; ?>],
 parseTime : false,
 xkey:'tiempo',
 ykeys:['label'],
 labels:['activity'],
 hideHover:'auto',
 hoverCallback: function (index, options, content) {
  var row = options.data[index];
  switch(row.label) {
    case 1:
        var activity1 = "Activity: Standing Still";
        break;
    case 2:
        var activity1 = "Activity: Walking";
        break;
    case 3:
        var activity1 = "Activity: Jogging";
        break;
    case 4:
        var activity1 = "Activity: Going Up Stairs";
        break;
    case 5:
        var activity1 = "Activity: Going Down Stairs";
        break;
    case 6:
        var activity1 = "Activity: Jumping";
        break;
    default:
        var activity1 = "I DONE FKED UP";
}
  return activity1;
}, 
 stacked:true,
 resize: true,
 lineColors: ['#FFA500', '#F64858', '#1BE71B'], 
 continuosLine: true,
 gridTextColor: '#171714',
 pointSize: 1, 
});
</script>



