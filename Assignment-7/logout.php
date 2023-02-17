<!-- If logged out session will destroy and user will be redirected to the index page -->
<?php
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
header('Location: index.php');
exit;
?>