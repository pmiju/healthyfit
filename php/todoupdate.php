<?php
    $conn = mysqli_connect("localhost", "", "", "healthyfit"); // 개발자 MYSQL 이름, 비밀번호
    mysqli_query($conn, 'SET NAMES utf8');

    $userEmail = $_POST["userEmail"];
    $content = $_POST["content"];
    $date = $_POST["date"];

    $statement = mysqli_prepare($conn, "UPDATE todo SET content = ? WHERE userEmail = ? AND date = ?");
    mysqli_stmt_bind_param($statement, "sss", $content, $userEmail, $date);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);

    $response = array();
    $response["success"] = true;

    echo json_encode($response);
?>