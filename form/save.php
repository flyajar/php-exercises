<?php

$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$birthday = $_POST['birthday'];
$age = $_POST['age'];
$gender = $_POST['gender'];

$isValid = preg_match("/^[a-z0-9 ,.\-]+$/i", $name);

if (! $isValid) {
    echo json_encode(["error" => "invalid name", "status_code" => 422]);
    return;
}

$bool = filter_var($email, FILTER_VALIDATE_EMAIL);

if ($bool === false) {
    echo json_encode(["error" => "invalid email", "status_code" => 422]);
    return;
}

$count = strlen($number);

if ($count > 11 || $count < 11) {
    echo json_encode(["error" =>  "mobile number must be 11 digits", "status_code" => 422]);
    return;
}

$firstTwoNum = substr($number, 0, 2);

if ($firstTwoNum != "09") {
    echo json_encode(["error" => "mobile number must start with 09", "status_code" => 422]);
    return;
}

$currentDate = new DateTime();

if ($birthday > $currentDate)
{
    echo json_encode(["error" => "invalid birthday", "status_code" => 422]);
    return;
}

if ($age < 0)
{
    echo json_encode(["error" => "invalid age", "status_code" => 422]);
    return;
}


$servername = "localhost";
$username = "root";
$password = "";
$db = "";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `profile`( `name`, `email`, `number`, `birthday`, `age`, `gender`) 
	VALUES ('$name','$email','$number','$birthday','$age','$gender')";

    $conn->exec($sql);

    echo json_encode(["status_code"=>200]);
} catch (PDOException $exception) {
    echo json_encode(["status_code"=> 500, "error" => $exception->getMessage()]);
}



//if ($conn->exec($sql)) {
//    echo json_encode(["status_code"=>200]);
//} else {
//    echo json_encode(["status_code"=> 500]);
//}

//mysqli_close($conn);
$conn=null;

