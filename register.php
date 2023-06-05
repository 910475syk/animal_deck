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
    fclose($userindexO);
    // 加入new user data
    $userindexR[count($userindexR)] = $newuser;
    $userindexR = json_encode($userindexR);
    // 寫入index檔案
    $userindexO = fopen("data/json/user/index.json", "w");
    fwrite($userindexO, $userindexR);
    fclose($userindexO);

    // 創建使用者個人檔案
    $newuser_json = array();
    $newuser_json['username'] = $_POST['account'];
    $newuser_json['userhead'] = "data/images/user/".$_POST['gender'].".png";
    $newuser_json['gender'] = $_POST['gender'];
    $newuser_json['e-mail'] = $_POST['email'];
    $newuser_json['cards'] = array();
    $newuser_json = json_encode($newuser_json);
    $userindex_jsonO = fopen("data/json/user".$_POST['account'].".json", "w");
    fwrite($userindex_jsonO, $newuser_json);
    fclose($userindex_jsonO);

    // 建立使用者大頭貼圖庫
    mkdir("data/images/user/".$_POST['account']."/");

    // 完成登入
    $_SESSION['user'] = $_POST['account'];




?>