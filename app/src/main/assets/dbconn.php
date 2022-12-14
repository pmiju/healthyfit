<?php
    $servername = "127.0.0.1:3307";
    $username = "root";
    $password = "019493";
    $dbname = "healthyfit";

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    try {

        $conn = new PDO("mysql:host={$servername};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage()); 
    }


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>