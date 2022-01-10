<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>bKash Banner</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <style type="text/css">
            .navbar .navbar-nav li a {
                color: #fff;
            }
            .navbar .navbar-nav li a:hover {
                color: #fff;
                background: #f15b9c;
            }
        </style>
    </head>
    <body style="background: #fde8f1;">
        <nav class="navbar navbar-fixed-top" style="background: #E2136E;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar" style="background: #fff;"></span>
                    <span class="icon-bar" style="background: #fff;"></span>
                    <span class="icon-bar" style="background: #fff;"></span>                        
                    </button>
                    <a class="navbar-brand" style="color: #fff;" href="dashboard.php">b<span style="color: #f58ab8;font-weight: bold;">K</span>ash <span style="color: #f58ab8;font-weight: bold;">B</span>anner</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="dashboard.php">Home</a></li>
                        <li><a href="bannerlist.php">Banner List</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br><br>
        <div class="container">
            