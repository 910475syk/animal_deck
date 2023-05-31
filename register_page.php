<?php 
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8"> 
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/register.css">
        <title>REGISTER</title>
    </head>
    <body>
        <div class="wrapper">
            <main>
                <form action="" method="POST" class="registerPage">
                    <h1>Create Your Animal Deck</h1>
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="account">帳號</label></td>
                                <td><input type="input" name="account"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td><label for="password">密碼</label></td>
                                <td><input type="password" name="password"></td>
                            </tr>
                            <tr class="remind">
                                <td colspan="2">※密碼須包含一個大寫字母與一個數字，並且大於四碼</td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>性別</td>
                                <td>
                                    <input type="radio" name="gender" value="male">
                                    <label for="gender">男</label>
                                    <input type="radio" name="gender" value="female">
                                    <label for="gender">女</label>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td><label for="email">E-MAIL</label></td>
                                <td><input type="email" name="email"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td><label for="termsOfService">服務條款</label></td>
                                <td>
                                    <input type="radio" name="termsOfService" value="agree"><button>點擊查看</button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="submit_container">
                                <td colspan="2"><input type="submit" value="註冊"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/register.js"></script>


    </body>
</html>










