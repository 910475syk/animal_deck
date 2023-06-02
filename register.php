<?php
    session_start();

    if(!isset($_POST['account'])){
        return;
    }
    if(!isset($_POST['password'])){
        return;
    }
    if(!isset($_POST['gender'])){
        return;
    }
    if(!isset($_POST['email'])){
        return;
    }
    // index備份
    // parent -> grandP
    if(file_exists("data/json/user/grandP_index.json")){
        unlink("data/json/user/grandP_index.json");
    };
    if(file_exists("data/json/user/parents_index.json")){
        rename("data/json/user/parents_index.json", "data/json/user/grandP_index.json");
    };

    // index -> paernt
    $indexO = fopen("data/json/user/index.json", "r") or die("Unable to open file!");
    $indexR = fread($indexO, filesize("data/json/user/index.json"));
    fclose($indexO);
    $parents_index = fopen("data/json/user/parents_index.json", "w");
    fwrite($parents_index, $indexR);
    fclose($parents_index);


    // 寫入index
    // 建立new user data
    $newuser = array();
    $newuser['account'] = $_POST['account'];
    $newuser['password'] = $_POST['password'];
    // 讀取index檔案
    $userindexO = fopen("data/json/user/index.json", "r") or die("Unable to open file!");
    $userindexR = fread($userindexO, filesize("data/json/user/index.json"));
    $userindexR = json_decode($userindexR, true);







?>