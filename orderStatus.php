<?php
session_start();

include('header_customer.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <style>

        body{
            margin:0;
            font-family:Arial, sans-serif;

            background:repeating-linear-gradient(
                90deg,
                #344e6f,
                #344e6f 40px,
                #6d819b 40px,
                #6d819b 80px
            );
        }

        .loader-container{
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .content{
            text-align:center;
        }

        .loader{
            width:800px;
            height:20px;
            border: 3px solid #1f3552;
            border-radius:25px;
            background:
            linear-gradient(#182C52 0 0) 0/0% no-repeat
            #9CB5E6;

            animation:l2 10s infinite steps(10);

            margin-bottom:20px;
        }

        .status-img{
            width:800px;
            max-width:100%;
            display:block;
        }

        @keyframes l2{
            100%{
                background-size:110%;
            }
        }

    </style>

</head>

<script>
setTimeout(function(){

    alert("Your order has been delivered!");

    window.location.href = "menu.php";

}, 10000);
</script>

<body>
    
    <div class="loader-container">

        <div class="content">
            <img src="images/status.png" alt="Order Status" class="status-img">

            <div class="loader"></div>

        </div>

    </div>

</body>
</html>