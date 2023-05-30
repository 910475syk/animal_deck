<?php 
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Animal Illustrated LOGIN</title>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <div class="wrapper">
            <main>
                <form action="check.php" class="loginPage" method="POST">
                    <h1>Open The Secrets Of Animal</h1>
                    <span>帳號</span><input type="input" name="account"><br>
                    <span>密碼</span><input type="password" name="password"><br>
                    <span class="warning display_none">帳號或密碼錯誤！</span><br>
                    <input type="submit" value="登入"><br>
                    <a href="register_page.php">還沒有帳號？ 點此註冊</a>
                </form>
            </main>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function(event){
                    // 
                    let user_login = {};
                    $('form').submit(function(event){
                        event.preventDefault();
                        $(this).find('input').each(function(){
                            user_login[$(this).attr('name')] = $(this).val();
                        });
                        $.ajax({
                            type: "POST",
                            url: "check.php",
                            data: user_login,
                            success: function(data){
                                if(data !== "帳號或密碼錯誤!"){
                                    $('span.warning').addClass('display_none');
                                    location.href = "/index.php";
                                } else {
                                    $('span.warning').removeClass('display_none');
                                }
                            },
                            error: function(xhr){
                                alert("An Error Occured" + xhr.status + " " + xhr.statusText);
                            }
                        })
                    })
                    // 
                })
            </script>

        </div>
    </body>
</html>




















