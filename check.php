<?php

    session_start();

    $userIndexO = fopen("data/json/user/index.json", "r") or die("Unable to open file!");
    $userIndexR = fread($userIndexO, filesize("data/json/user/index.json"));
    $userIndexR = json_decode($userIndexR);
    fclose($userIndexO);

    for($i=0; $i<count($userIndexR); $i++){
        $user[$i] = json_decode(json_encode($userIndexR[$i]), true);
        if($_POST['account'] == $user[$i]['account'] && $_POST['password'] == $user[$i]['password']){
            $_SESSION['user'] = $_POST['account'];
            $check = true;
            break;
        } else {
            $check = false;
        };
    };
    if($check == false){
        echo "帳號或密碼錯誤！";
    };
    // sign out
    if(isset($_POST['event'])){
        if($_POST['event'] == "signOut"){
            unset($_SESSION['user']);
        };
    };



?>