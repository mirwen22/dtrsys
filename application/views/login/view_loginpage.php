<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DTR Sys</title>

    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="template/css/animate.css" rel="stylesheet">
    <link href="template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">DTR</h1>

            </div>
            <h3>Welcome to DTR System</h3>

          
            <p>Login in</p>

            <?php echo validation_errors(); ?>  

            <form class="m-t" role="form" method="post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" value="superadmin" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" value="Qwerty!2345" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            </form>
            <p class="m-t"> <small>MJO &copy; 2022</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="template/js/jquery-3.1.1.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>

</body>

</html>
