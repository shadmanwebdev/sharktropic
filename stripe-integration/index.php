<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #252930;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn {
            transition: none;
        }
        .btn:hover {
            color: #252930;
            text-decoration: none;
        }
        .btn:focus, .btn.focus {
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(69, 80, 230, 0.25);
        }
        .btn-primary {
            color: #fff;
            background-color: #4550E6;
            border-color: #4550E6;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #2330e1;
            border-color: #1d2adb;
        }
        .btn-primary:focus, .btn-primary.focus {
            color: #fff;
            background-color: #2330e1;
            border-color: #1d2adb;
            box-shadow: 0 0 0 .2rem rgba(97, 106, 234, 0.5);
        }
    </style>
    

    <!-- Use action="/create-checkout-session.php" if your server is PHP based. -->
    <form action="./create-checkout-session.php" method="POST">
      <button class='btn btn-primary' type="submit">Checkout</button>
    </form>


    




</body>
</html>