<html>
    <head>
        <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="{$URL_ASSETS}/css/styles.css" />
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="{$URL_ASSETS}/js/main.js"></script>
    </head>
    <body>
        <h1> Login </h1>
        <form action="{$Routes->pathOfRoute('actionLogin')}" method="get">
            <input type="text" name="username" /><br>
            <input type="password" name="password" /><br>
            <input type="submit" /><br>
        </form>
    </body>
</html>