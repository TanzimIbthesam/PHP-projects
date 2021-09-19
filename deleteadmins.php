<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
if(isset($_GET['id'])){
    $searchqueryparameter=$_GET['id'];
    global $conn;
   
    $sql="DELETE  FROM admins WHERE id='$searchqueryparameter'";
    $execute=$conn->query($sql);

    if($execute){
        $_SESSION['SuccessMessage']="Admin deleted successfully";
        redirect_to('admins.php');
    }else{
        $_SESSION['ErrorMessage']="Something went wrong.Please try again";
        redirect_to('admins.php');
    }
}


?>