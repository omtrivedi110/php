<?php

    header("Access-Control-Allowed-Method: POST");
    header("Content-Type: application/json");

    include("../config/config.php");

    $res = array();

    $config = new Conect();

    if($_SERVER['REQUEST_METHOD'] == "POST"){


        $data = $_FILES;

        $name = $data['name']['name'];
        $path = $data['name']['tmp_name'];

        $destination = "../upload/" . uniqid("omimg-"). $name;

        $uploaded = move_uploaded_file($path,$destination);

        if($uploaded){

            $config->insert_media($name,$destination);

            $res['msg'] = "Successfully uploaded..";
           
        }else{
            $res['msg'] = "failed to upload..";
           
        }
        // $name = $data['']
    }else{

        $res['msg'] = "Only POST method is allowed...";
    }

    echo json_encode($res);


?>