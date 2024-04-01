<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "knight_saver";  
    $link = new mysqli($servername, $username, $password, $db_name);
    if($link->connect_error){
        die("Connection failed".$link->connect_error);
    }
    echo "";
    
