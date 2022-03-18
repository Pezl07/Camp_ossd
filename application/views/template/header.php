<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no" />
    <title><?php echo $views ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
        type="text/css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200&family=Sarabun:wght@100&display=swap"
        rel="stylesheet">
    <style type="text/css">
    *:not(i) {
        font-family: 'Mitr', sans-serif !important;
    }

    html,
    body {
        height: 100%;
    }

    body {
        background-color: white !important;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: grayscale;
    }

    .ui.menu {
        top: 0px !important;
        position: fixed;
        width: 100%;
        padding: 10px 10px;
        margin: 0 0 !important;
        background-color: #141E27 !important;
        z-index: 1;
    }

    .ui.menu * {
        color: white !important;
    }

    .ui.menu .item .bars.icon {
        font-size: 30px;
        margin: 0 !important;
    }

    .ui.avatar {
        cursor: pointer;
        font-size: 25px;
        margin-left: 10px !important;
    }

    .btn-logout {
        top: 65px;
        right: 20px;
        width: 130px;
        padding: 5px;
        box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
        border-radius: 5px;
        background-color: rgba(252, 252, 252, 0.8);
        position: absolute;
    }

    .ui.dropdown {
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .menu-setting {
        font-size: 20px;
        font-weight: bold;
        border-bottom: 1px solid black;
    }

    .menu-setting .active {
        background-color: #DEE3E2;
        border: 1px solid black;
    }

    .menu-setting *:not(:last-child) {
        cursor: pointer;
        border-radius: 10px 10px 0 0;
    }

    .menu-setting *:not(:last-child):hover {
        color: white;
        background-color: gray !important;
        border: 1px solid black;
    }

    @media only screen and (max-width: 800px) {
        .menu-setting {
            display: inline !important;
        }

        .menu-setting * {
            width: 100% !important;
        }

        .menu-setting div:nth-child(2) {
            border-radius: 0 0 10px 10px;
        }

        .menu-setting *:last-child {
            margin-top: 10px !important;
            width: 100% !important;
            float: none !important;
        }
    }
    </style>
</head>

<body>

    <div class="ui sidebar inverted vertical menu">
        <div class="Logo-camp text-center mb-3" style="cursor: pointer"
            onclick="window.location.href = '<?= base_url(); ?>'">
            <img src="https://se.buu.ac.th/gami_ossd/assets/dist/img/cluster/cluster4.png" style="width: 100px;">
            <h5>OSSD CAMP #10</h5>
        </div>
        <a class="item" href="<?= base_url(); ?> ">
            <h5>
                <i class="chart bar icon"></i>
                Dashboard
            </h5>
        </a>
        <a class="item" href="<?= base_url(); ?>index.php/C_Shopping/show_shopping">
            <h5>
                <i class="shopping cart icon"></i>
                Shopping
            </h5>
        </a>

        <?php if($_SESSION['user']->role == 'admin'|| $_SESSION['user']->role == 'พี่เลี้ยง'){ ?>

        <a class="item" href="<?= base_url(); ?>index.php/C_Assess/show_assess">
            <h5>
                <i class="clipboard list icon"></i>
                Assess
            </h5>
        </a>

        <?php } ?>

        <?php if($_SESSION['user']->role == 'admin'){ ?>

        <a class="item" href="<?= base_url(); ?>index.php/C_Setting/show_setting">
            <h5>
                <i class="cog icon"></i>
                Setting
            </h5>
        </a>

        <?php } ?>

    </div>

    <div class="pusher">

        <div class="ui secondary menu">
            <a class="item open-sidebar">
                <i class="bars icon"></i>
            </a>
            <div class="item">
                <h3> <?php echo $views  ?> </h3>
            </div>
            <div class="right menu">
                <div class="ui list m-0 align-middle mt-2" style="text-align: right">
                    <div class="item">
                        <?php echo $_SESSION['user']->name; ?>
                    </div>
                    <div class="item">
                        ตำแหน่ง : <?php echo $_SESSION['user']->role; if($_SESSION['user']->role != 'admin') echo ' มกุล '. $_SESSION['user']->team; ?>
                    </div>
                </div>
                <img class="ui avatar image" src="https://semantic-ui.com/images/wireframe/square-image.png">
                </img>
                <div class="btn-logout text-center transition hidden">
                    <a class="ui red button m-0" href="<?= base_url(); ?>index.php/C_Login/logout"> LOGOUT </a>
                </div>
            </div>
        </div>

        <div style="padding-bottom: 100px"></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <script>
        $('.ui.avatar').on('click', function() {
            if ($('.btn-logout').hasClass('visible') == 0)
                $('.btn-logout').transition('slide down');
        });

        $("body").click(
            function(e) {
                if (e.target.className !== ".ui.avatar" && $('.btn-logout').hasClass('visible')) {
                    $('.btn-logout').transition('slide down');
                }
            }
        );
        </script>