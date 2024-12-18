<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name ="banko";
    $connect = mysqli_connect($servername, $username, $password, $db_name);
    if(mysqli_connect_error()):
        echo "falha na conexâo: " . mysqli_connect_error();
    endif; 
?>