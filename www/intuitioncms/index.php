<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" ng-app="animeTypes">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <title>Anime-types.com</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <!-- controllers -->
    <script src="app/controllers/characterctrl.js"></script>

    <!-- App -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../lib/html5shiv.js"></script>
    <script src="../lib/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <?php
    if(isset($_POST["username"]) && isset($_POST["password"])){

        //validation and login check
        if($_POST["username"] == "smokeweedeveryday" && $_POST["password"] == "Kanker2"){

            $_SESSION["loggedin"] = true;
            header('Location: manage.php');

        }else{
            $errorMessage = "Invalid username and password";
        }
    }
    ?>

    <div class="container">
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Username</label>
            <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <?php if(isset($errorMessage)): ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $errorMessage;?>
            </div>
            <?php endif; ?>
        </form>

    </div>


<footer>

</footer>

<script src="../lib/jquery-1.11.1.min.js"></script>
<script src="../lib/jquery-migrate-1.2.1.min.js"></script>
<script src="../lib/bootstrap.min.js"></script>

</body>
</html>