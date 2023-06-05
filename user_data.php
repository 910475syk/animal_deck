<?php

    session_start();

    if(isset($_SESSION['user'])){
        if($_POST['get_data'] == "start"){
            // 匯入user資料
            $username = $SESSION['user'];
            if(!file_exists("data/json/user/".$username.".json")){
                echo "Unable to open file!";
            } else {
                $userfileO = fopen("data/json/user/".$username.".json", "r");
                $userfileR = fread($userfileO, filesize("data/json/user/".$username.".json"));
                $userfileR = json_decode($userfileR, true);
                fclose($userfileO);

                // get user card index
                $user_card_group = array_keys($userfileR['cards']);

                // get user cards data
                for($j=0; $j<count($user_card_group); $j++){
                    $the_animal = $user_card_group[$j];
                    $the_animal_array = $userfileR['cards'][$the_animal];
                    for($k=0; $k<count($the_animal_array); $k++){
                        $the_path = "data/json/animal/".$the_animal."/".$the_animal_array[$k].".json";
                        $cardOpen = fopen($the_path, "r") or die("Unable tp open file!");
                        $userfileR['cards'][$the_animal][$the_animal_array[$k]] = json_decode(fread($cardOpen, filesize($the_path)), true);
                        fclose($cardOpen);
                    }
                };
                echo json_encode($userfileR);
            }
        }
    }

?>