
<?php 
$connect = mysqli_connect("localhost", "root", "equipohar123", "testing_har");
$query = ("SELECT * FROM testing_data WHERE labelRF IS NOT NULL ORDER BY id DESC LIMIT 1"); 
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
echo $row['labelRF'];
?>

