<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbconn.php');

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    $exNum = isset($_GET['exNum']) ? $_GET['exNum'] : '';
    $exLevel = isset($_GET['exLevel']) ? $_GET['exLevel'] : '';

    $sql = "select * from exercise where exLevel='1'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() == 0) {
        echo "";
        echo $exLevel;
        echo "은 찾을 수 없습니다.";
    } else {
        $data = array();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            array_push($data, array('exImg'=>$row['exImg'], 'exName'=>$row['exName']));
        }
        if(!$android) {
            echo "<pre>";
            print_r($data);
            echo '</pre>';
        } else {
            header('Content-Type: application/json; charset=utf8');
            $json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
            echo $json;
        }
    }
?>