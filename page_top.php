<?php
// top of all pages
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title>PHP Ajax</title>
        <script>
            function showEmployee(str) {
                if (str == "") {
                    document.getElementById("emp_details").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("emp_details").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getemployee.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        
        <style>
            .tdTitle {
                background-color:black;
                color:white
            }
        </style>
        
    </head>
    <body>
        <div class="container">

            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Special Topics</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="getemployee.php">getemployee.php</a></li>
                        <li><a href="employees_ajax_jquery.php">Employees jQuery</a></li>
                        <li><a href="employees_angular.php">Angular Example</a></li>
                        <li><a href="employees_mysql.php">Employees Data</a></li>
                        <li><a href="orders.php">Orders</a></li>
                    </ul>
                </div>
            </nav>