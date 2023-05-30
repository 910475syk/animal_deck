<?php
    $animal_index = array(1 => 'dog', 2 => 'cat', 3 => 'wolf', 4 => 'jellyfish');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['animal'])){
            for($i=1; $i<=count($animal_index); $i++){
                if($_POST['animal'] == $animal_index[$i]){
                    // 開啟、讀取動物資料
                    $myAnimal = fopen("data/json/common".$_POST['animal'].".json", "r") or die("Unable to open file!");
                    $animal_list = fread($myAnimal, filesize("data/json/common/".$_POST['animal'].".json"));
                    $animal_list = json_decode($animal_list);
                    fclose($myAnimal);
                    // 傳送指定動物編號
                    $noa_boat = array();
                    $i = 0;
                    for($a=$_POST['num']; $a<$_POST['num']+3; $a++){
                        if(isset($animal_list[$a])){
                            $nao_boat[$i] = $animal_list[$a];
                            $i++;
                        };
                    };
                    echo json_encode($nao_boat);
                    break;
                };
            };
        };
    };



?>

























