<?php
$connect = mysqli_connect("localhost", "root", "equipohar123", "testing_har");
$query = ("SELECT * FROM testing_data WHERE labelRF IS NOT NULL ORDER BY id DESC LIMIT 1");
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$label = $row['labelRF'];
$query2 = ("SELECT * FROM labels WHERE id_label = $label");
$result2 = mysqli_query($connect, $query2);
$row2 = mysqli_fetch_array($result2);
echo $row2['tipo_label'];
?>


