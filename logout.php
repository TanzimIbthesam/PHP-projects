<?php 

require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");

?>
<?php 
$_SESSION['userID']=null;
$_SESSION['userName']=null;
$_SESSION['adminName']=null;
session_destroy();
redirect_to('login.php');
?>