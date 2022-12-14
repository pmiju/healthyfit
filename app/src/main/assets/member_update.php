<?php
$conn = mysqli_connect("127.0.0.1:3307", "root", "019493", "healthyfit");
mysqli_query($conn, 'SET NAMES utf8');

$userEmail = $_POST["userEmail"];
$userWeight = $_POST["userWeight"];
$userBMI = $_POST["userBMI"];
$userETC = $_POST["userETC"];
$userHeight = $_POST["userHeight"];

$statement = mysqli_prepare($conn, "UPDATE membertbl SET userHeight = ?, userWeight = ?, userBMI = (?/pow(?,2))*10000, userETC = ? WHERE userEmail = ?");
mysqli_stmt_bind_param($statement, "iiiiss", $userHeight, $userWeight, $userWeight, $userHeight, $userETC, $userEmail);
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);

$response = array();
$response["success"] = true;

echo json_encode($response);
?>
<html>
   <body>

        <form action="<?php $_PHP_SELF ?>" method="POST">
            userEmail: <input type = "text" name = "userEmail" />
            userHeight: <input type = "text" name = "userHeight" />
            userWeight: <input type = "text" name = "userWeight" />
            userETC: <input type = "text" name = "userETC" />
            <input type = "submit" name = "submit" />
        </form>
   
   </body>
</html>
