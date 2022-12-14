<?php
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;
 
        $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
 
    if( !$android )
    {
?>
    <html>
       <body>
            <form action="exercise_insert.php" method="POST" enctype="multipart/form-data">
                exImg: <input class = "button" type = "file" name = "exImg" />
                exName: <input type = "text" name = "exName" />
                exEx: <input type =textarea row="10" cols="45" name = "exEx"/>
                exPart: <input type = "text" name = "exPart" />
                exLevel: <input type = "text" name = "exLevel" />
                exCal: <input type = "text" name = "exCal" />
                exUrl : <input type = "text" name = "exUrl"/>
                <input type = "submit" name = "submit" />
            </form>
 
       </body>
    </html>
<?php
    }
?>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    
    include('dbconn.php');
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if((($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android)
    {
        $exName = $_POST["exName"];
        $exEx = $_POST["exEx"];
        $exPart = $_POST["exPart"];
        $exLevel = $_POST["exLevel"];
        $exCal = $_POST["exCal"];
        $exUrl = $_POST["exUrl"];

        if($_FILES['exImg']['name']) {
            $imageFullName = strtolower($_FILES['exImg']['name']);
            $imageNameSlice = explode(".", $imageFullName);
            $imageName = $imageNameSlice[0];
            $imageType = $imageNameSlice[1];
            $image_ext = array('jpg','jpeg','gif', 'png');
            if(array_search($imageType, $image_ext) === false) {
                errMsg('jpg, jpeg, gif, png 확장자만 가능합니다.');
            }
            $dates = date("mdhis",time());
            $newImage = chr(rand(97,122)).chr(rand(97,122)).$dates.rand(1,9).".".$imageType;
            $dir = "C://CookAndroid/Project/healthyfit/app/src/main/res/drawable/";
            move_uploaded_file($_FILES['exImg']['tmp_name'], $dir.$newImage);
            chmod($dir.$newImage,0777);
        }

        if(!isset($errMSG)) {
            try {
                $stmt = $conn->prepare('INSERT INTO exercise(exImg, exName, exEx, exPart, exLevel, exCal, exUrl) VALUES(:exImg, :exName, :exEx, :exPart, :exLevel, :exCal, :exUrl)');
                $stmt->bindParam(':exImg', $newImage);
                $stmt->bindParam(':exName', $exName);
                $stmt->bindParam(':exEx', $exEx);
                $stmt->bindParam(':exPart', $exPart);
                $stmt->bindParam(':exLevel', $exLevel);
                $stmt->bindParam(':exCal', $exCal);
                $stmt->bindParam(':exUrl', $exUrl);

                if($stmt->execute())
                {
                    $successMSG = "success";
                }
                else
                {
                    $errMSG = "fail";
                }
            } catch(PDOException $e) {
                die("Database error : ". $e->getMessage());
            }
        }
    }
?>

