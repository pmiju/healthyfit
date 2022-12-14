<?php
    $conn = mysqli_connect("localhost", "", "", "healthyfit"); // 개발자 MYSQL 이름, 비밀번호
    mysqli_query($conn, 'SET NAMES utf8');

     $userEmail = $_POST["userEmail"];
     $statement = mysqli_prepare($conn, "SELECT userEmail FROM membertbl WHERE userEmail = ?");

     mysqli_stmt_bind_param($statement, "s", $userEmail);
     mysqli_stmt_execute($statement);
     mysqli_stmt_store_result($statement);
     mysqli_stmt_bind_result($statement, $userEmail);

     $response = array();
     $response["success"] = true;

     while(mysqli_stmt_fetch($statement)){
       $response["success"] = false;
       $response["userEmail"] = $userEmail;
     }
     echo json_encode($response);

?>