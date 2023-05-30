<?php
session_start();
?>

<html>

<head>
    <meta charset="utf-8">
    <title>Animal Deck</title>
    <link rel="stylesheet" href="css/reset.css">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/indexAfterLogin.css">

</head>

<body>
    <div class="wrapper">
        <nav>
            <a href="login.php" id="loginBtn">您好，請登入</a>
        </nav>
        <h1>動物卡組</h1>
        <form action="animal_categotry.php" method="post">
            <p>選擇您的野獸</p>
            <select name="animal">
                <option value="dog">狗狗</option>
                <option value="cat">貓貓</option>
                <option value="wolf">狼狼</option>
                <option value="jellyfish">水母</option>
            </select>
            <br>
            <input type="submit" name="send" value="召喚野獸！！！">
        </form>

        <main>
            <div class="position_relative">
                <a href="javascript:;" id="flex_button">3</a>
            </div>
            <section id="animal_list"></section>

            <div class="position_relative m-t-80 display_none">
                <a href="javascript:;" id="wantMore">更多！！</a>
            </div>
        </main>
    </div>
    <div id="popup_background" class="display_none">
        <div class="popup_content">
            <p>登入會員，獲得更多野獸卡牌</p>
            <a href="javascript:;" class="later">稍後再說</a>
            <a href="login.php" class="login">登入</a>
        </div>
    </div>
    <div id="card-template" class="card threeCard display_none">
        <div class="card_thumb">
            <img src="pic_src" alt="animal_name">
        </div>
        <div class="card_content">
            <h3>TITLE</h3>
            <p>CONTENT</p>
        </div>
    </div>

    <?php if (isset($_SESSION['user'])) { ?>
        <!-- 登入後模板 -->
        <!-- login_data -->
        <div id="login_data_template" class="display_none">
            <div class="frame">
                <img src="" alt="">
            </div>
            <p></p>
            <a href="javascript:;" class="signOut">登出</a>
        </div>

        <!-- NEWCARD_template -->
        <div id="newCard_template" class="display_none">
            <img src="animal_pic" alt="animal_alt">
        </div>

        <!-- BUY_NEWCARD -->
        <div class="buy_card display_none">
            <p>您還未擁有此野獸喔！</p>
            <a href="javascript:;" class="later loginVer">稍後再說</a>
            <a href="buy_card.php" class="login">立即購買</a>
        </div>

    <?php } ?>



    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="js/index.js"></script>
    <?php if (isset($_SESSION['user'])) { ?>
        <script src="js/afterLogin.js"></script>
    <?php } ?>
</body>

</html>