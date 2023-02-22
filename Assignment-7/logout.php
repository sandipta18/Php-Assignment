<!-- If logged out session will destroy and user will be redirected to the index page -->
<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit;
?>