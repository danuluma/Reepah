<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="icon" type="image/png" href="images/DB_16х16.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {os_meta()}
        <link rel="stylesheet" href="{$system.home}/app/assets/node_modules/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="{$system.home}/app/assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.html">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{$system.home}/app/assets/node_modules/jquery-bar-rating/dist/themes/css-stars.html">
        <link rel="stylesheet" href="{$system.home}/app/assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.html" />
    <!-- inject:css -->
    {os_style( "style.css", 'local' )}
    {os_styles()}
    <!-- endinject -->
    <style type="text/css">
        .right {
            float: right;
        }

        .left {
            float: left;
        }

        .float {
            position: fixed;
            z-index: 10;
            bottom: 2%;
            right: 1%;
            background-color: rgb(0, 188, 212);
        }

        .text-center {
            text-align: center !important;
        }

        .grow {
          transition: all .2s ease-in-out;
        }

        .grow:hover {
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
            z-index: 800;
        }
        .card-title {
            top: -40px; position: relative; color: lightgreen
        }

        h1, .h1 {
            font-size: 5.1rem;
        }
    </style>
</head>
    <body style="background-color: white;">