<!-- If logged out session will destroy and user will be redirected to the index page -->
<?php

session_start();
session_unset();
session_destroy();
header('Location: index.php');

?>