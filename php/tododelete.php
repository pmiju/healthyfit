<?php
    $conn = mysqli_connect("localhost", "", "", "healthyfit"); // 개발자 MYSQL 이름, 비밀번호
   mysqli_query($conn, 'SET NAMES utf8');

    $content = $_POST["content"];
    $date = $_POST["date"];

    $statement = mysqli_prepare($conn, "DELETE FROM todo WHERE content = ? AND date = ?");
    mysqli_stmt_bind_param($statement, "ss", $content, $date);
    mysqli_stmt_execute($statement);

    $response = array();
    $response["success"] = true;

    echo json_encode($response);
?>


<html>
   <body>
   
      <form action="<?php $_PHP_SELF ?>" method="POST">
         내용: <input type = "text" name = "content" />
         <input type = "submit" />
      </form>
   
   </body>
</html>