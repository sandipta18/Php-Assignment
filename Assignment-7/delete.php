<?php
session_start();
if ($_SESSION['set'] == false) {
    header('location: ../Assignment-7/index.php');
}
include 'loadin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="css/style8.css">
</head>

<body>
    <form action="delete_db.php" method="POST">
        <input type="password" class="email" name="deletepass" placeholder="Enter Password to verify" required>
        <span class="error">
            <?php
            if (!$_SESSION['passvalidate']) {
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

