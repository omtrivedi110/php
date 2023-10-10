<?php

header("Access-Control-Allowed-Method: GET");
header("Content-Type: application/json");

include("../config/config.php");

$res = array();

$config = new Conect();

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $data = $config->get_media();

        $all_media = array();
        $res['data'] = array();

        while($record = mysqli_fetch_assoc($data)){
            array_push($all_media,$record['name']);
        }
       $res['data']=$all_media;
        
        echo json_encode($res);
}else{

    $res['msg'] = "Only GET method is allowed...";
}

?>