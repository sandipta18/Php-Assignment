<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>css delete button animation</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Popping', sans-serif;

        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #222;

        }

        button {
            position: relative;
            width: 160px;
            height: 50px;
            background: #333;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.5s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-decoration: none;

        }

        button.active {
            background: #2196f3;
        }

        button span {
            position: absolute;
            left: 40px;
            width: 18px;
            height: 20px;
            display: inline-block;
            background: #fff;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            transition: 0.5s;

        }

        button:hover span {
            transform: scale(1.5) rotate(60deg) translateY(10px);
        }

        button.active span {
            left: 50%;
            transform: translateX(-50%) rotate(-45deg);
            border-radius: 0;
            width: 20px;
            height: 10px;
            background: transparent;
            border-left: 2px solid #fff;
            border-bottom: 2px solid #fff;

        }



        button span::before {
            content: ' ';
            position: absolute;
            top: -3px;
            width: 100%;
            height: 2px;
            background: #fff;
            box-shadow: 12px -2px 0 #333,
                12px -3px 0 #333,
                15px -1px 0 #333,
                6px -2px 0 #fff;
            transition: 0.5s;
        }

        button.active:hover span::before,
        button.active span::before {
            transform: scale(0)
        }

        button:hover span::before {
            transform: rotate(-90deg) translateX(50%) translateY(-10px);
        }

        button text {
            position: absolute;
            right: 40px;
            color: #fff;
            transition: 0.5s;
        }

        button:hover text,
        button.active text {
            transform: translateX(-50px) translateY(-5px) scale(0);
        }

        .email {
            padding: 6px 40px;
            font-size: 18px;
        }

        .email:active {
            border: none;
        }

        .email:focus {
            outline: none;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="temp.php" method="POST">
        <input type="password" class="email" name="deletepass" placeholder="Enter Password to verify" required>
        <span class="error">
            <?php
            if ($_SESSION['passvalidate'] == false) {
                echo $_SESSION['wrongpass'];
                $_SESSION['wrongpass'] = "";
                

            }
            ?>
        </span>
        <button class="btn" name="submit"><span></span><text></text></button>

    </form>
    <script>
        let btn = document.querySelector('.btn');
        btn.onclick = function() {
            btn.classList.toggle('active')
        }
    </script>
</body>

</html>
<?php

?>