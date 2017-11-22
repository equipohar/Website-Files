    <?php
    session_start();
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
        echo "Email is: " . $_SESSION['email'] . ".<br>";
        echo "Name is: " . $_SESSION['username'] . ".<br>";
    }else{
        echo "Porq :(";
    }
    
    ?>