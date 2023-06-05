<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] != "POST"){
        return;
    }
    $accountO = fopen("data/json/user/index.json", "r") or die("Unable to open file!");  
    $accountR = fread($accountO, filesize("data/json/user/index.json"));
    $accountR = json_decode($accountR, true);
    fclose($accountO);  

    $accountCheck = true;
    for($i=0; $i<count($accountR); $i++){
        if($_POST['account'] == $accountR[$i]['account']){
            $accountCheck = false;
            break;
        }
    }
    if($accountCheck){
        echo "OK";
    } else {
        echo "hadSet";
    }

?>