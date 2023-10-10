<?php

header("Access-Control-Allowed-Method: POST");
header("Content-Type: application/json");

include("../config/config.php");

$config = new Conect();

$res = array();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $mail = $_POST['email'];
    $psw = $_POST['psw'];

    $psw2 = password_hash($psw,PASSWORD_DEFAULT);

    $rec = $config->register_user($name,$mail,$psw2);

    $res['msg'] = $rec ? "User Registerd" : "Something Went wrong";

    echo json_encode($res);
}else{
    $res['msg'] = "Only POST method is allowed";

    echo json_encode($res);
}

?>