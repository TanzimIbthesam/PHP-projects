<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
// $_SESSION['TrackingURL']=$_SERVER["PHP_SELF"];
// confirm_login();
if(isset($_GET['id'])){
    $searchqueryparameter=$_GET['id'];
    global $conn;
    $admin=$_SESSION['userName'];
    $sql="UPDATE comments SET status='OFF',approvedby='$admin' WHERE id='$searchqueryparameter'";
    $execute=$conn->query($sql);

    if($execute){
        $_SESSION['SuccessMessage']="Comment got dis-approved successfully";
        redirect_to('comments.php');
    }else{
        $_SESSION['ErrorMessage']="Something went wrong.Please try again";
        redirect_to('comments.php');
    }
}

?>
