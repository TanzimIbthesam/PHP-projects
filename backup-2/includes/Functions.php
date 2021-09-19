<?php 

function redirect_to($newlocation){
    header("Location:".$newlocation);
    exit();
}


?>