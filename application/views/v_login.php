<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no" />
    <title>LOGIN OSSD CAMP #10</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
        type="text/css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200&family=Sarabun:wght@100&display=swap"
        rel="stylesheet">
    <style type="text/css">
    *:not(i) {
        font-family: 'Mitr', sans-serif !important;
    }
    body {
        background-color: #dadada;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: grayscale;
    }

    body>.ui.grid {
        height: 100%;
    }

    .ui.header {
        font-size: 6em !important;
    }

    @import url('https://fonts.googleapis.com/css?family=Exo:400,700');

    * {
        margin: 0px;
        padding: 0px;
    }

    body {
        font-family: 'Exo', sans-serif;
        background: #4e54c8;
        background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
    }


    .context {
        width: 100%;
        position: absolute;
        top: 50vh;

    }

    .context h1 {
        text-align: center;
        color: #fff;
        font-size: 50px;
    }

    .circles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .circles li {
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.2);
        animation: animate 25s linear infinite;
        bottom: -150px;

    }

    .circles li:nth-child(1) {
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
    }


    .circles li:nth-child(2) {
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
    }

    .circles li:nth-child(3) {
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
    }

    .circles li:nth-child(4) {
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 18s;
    }

    .circles li:nth-child(5) {
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
    }

    .circles li:nth-child(6) {
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
    }

    .circles li:nth-child(7) {
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
    }

    .circles li:nth-child(8) {
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
    }

    .circles li:nth-child(9) {
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
    }

    .circles li:nth-child(10) {
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 0s;
        animation-duration: 11s;
    }



    @keyframes animate {

        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }

        100% {
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }

    }

    .column {
        max-width: 700px;
        min-width: 100px;
    }

    .form .ui.segment {
        border-radius: 60px !important;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.5) 0px 8px 16px -8px;
    }

    .input {
        width: 60% !important;
    }

    .error {
        color: red;
    }

    .icon_eye {
        color: rgba(0,0,0,0.4);
        font-size: 20px;
        padding:5px 5px 0 0;
        position: absolute;
        right: 0;
    }

    #hide {
        display: none;
    }
    </style>
</head>

<body id="root">

    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <div class="ui middle aligned center aligned grid">
        <div class="column m-4">
            <form class="ui large form" action="<?= base_url();?>index.php/C_Login/login" method="POST">
                <div class="ui segment py-5">
                    <h1 class="ui header"> LOGIN </h1>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input name="username" placeholder="Username" type="text" id="username"
                                value="<?php echo (isset($username))? $username:'' ?>" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password" placeholder="Password" type="password" id="password"
                                value="<?php echo (isset($password))? $password:'' ?>" />
                            <div class="icon_eye">
                                <i class="eye icon" id="show" onclick="show_eye()"></i>
                                <i class="eye slash outline icon" id="hide" onclick="show_eye()"></i>
                            </div>
                        </div>
                    </div>

                    <?php 
                        if(isset($error))
                        echo '<h5 class="mt-4 mb-2 error">'.$error.' </h5>';
                    ?>

                    <button type="submit" class="ui big green submit button px-5 mt-4">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
function show_eye() {
    var input_password = $('#password').attr('type');
    if (input_password === "password") {
        console.log('ll');
        $("#password").prop("type", "text")
        $('#hide').css("display", "inline-block");
        $('#show').css("display", "none");
    } else {
        $("#password").prop("type", "password")
        $('#hide').css("display", "none");
        $('#show').css("display", "inline-block");
    }
}
</script>

</html>