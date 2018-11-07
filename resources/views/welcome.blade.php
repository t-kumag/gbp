<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        signup<br>
        <form action="http://localhost:8000/api/v1/user/signup" method="post">
            login_id : <input type="text" name="login_id" value="user"><br>
            password : <input type="text" name="password" value="user"><br>
            mail : <input type="text" name="mail" value="user"><br>
            <input type="submit" value="signup">
        </form>

        login<br>
        <form action="http://localhost:8000/api/v1/user/login" method="post">
            login_id : <input type="text" name="login_id" value="user"><br>
            password : <input type="text" name="password" value="user"><br>
            <input type="submit" value="login">
        </form>

        <br>logout<br>
        <a href="http://localhost:8000/api/v1/user/logout">logout</a>

        <br>test<br>
        <a href="http://localhost:8000/api/v1/user/test">test</a>

        families<br>
        <form action="http://localhost:8000/api/v1/families/child" method="post">
            なまえ : <input type="text" name="name" value="子供"><br>
            なまえかな : <input type="text" name="name_kana" value="こども"><br>
            誕生日：<input type="date" name="birthday">
            <input type="submit" value="child">
        </form>
    </body>
</html>
