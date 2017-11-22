<?php
session_start();
if(isset($_POST) & !empty($_POST)){
  include 'configuracion_har.php';
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = mysqli_query($mysqli, $sql);
  $count = mysqli_num_rows($result);
  if($count == 1){

  	$servername = '127.0.0.1';
    $usernamedb = 'root';
    $password = 'equipohar123';
    $dbname = 'testing_har';
    $conn = new mysqli($servername, $usernamedb, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT email FROM user WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row["email"];
        }
    } else {
        echo "0 results";
    }

    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;

    sleep(5);
    header('Location: http://www.track-mymovement.tk/HAR/graficas/lineas/lineas.php');
    exit();
  }else{
    $fmsg = "User Login Failed";
  }
}
if(isset($_SESSION['username'])){
    $smsg = "User already logged in";
    sleep(5);
    header('Location: http://www.track-mymovement.tk/HAR/graficas/lineas/lineas.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
     
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
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
  <li><a class="active" href="logout.php">Logout</a></li>
  <?php else: ?>
  <li><a class="active" href="login.php">Login</a></li>
  <?php endif; ?>
  <li style="float: right"><a href="register.php">Register</a></li>
</ul>
<div class="container">  
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please Login</h2>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">@</span>
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
</div>

</body>
</html>