<?php 
require_once ("includes/DB.php");
function redirect_to($newlocation){
    header("Location:".$newlocation);
    exit();
}

function CheckUserNameExistsOrNot($username){
    global $conn;
    $sql    = "SELECT username FROM admins WHERE username=:userName";
    $stmt   = $conn->prepare($sql);
    $stmt->bindValue(':userName',$username);
    $stmt->execute();
    $Result = $stmt->rowCount();
    if ($Result==1) {
      return true;
    }else {
      return false;
    }
  }
  function login_attemt($username,$password){
    global $conn;
    $sql="SELECT * from admins WHERE username=:userName and password=:passWord LIMIT 1";
    $stmt=$conn->prepare($sql);
    $stmt->bindValue(':userName',$username);
    $stmt->bindValue(':passWord',$password);
    $stmt->execute();
    $result=$stmt->rowcount();

    if($result==1){
     return $found_account=$stmt->fetch();
    }else{
     return null;
    }
  }
  function confirm_login(){
    if(isset($_SESSION['userID'])){
      return true;
    }else{
       $_SESSION['ErrorMessage']='Login Required';
         redirect_to('login.php');
  

  }
 
}
function totalposts(){
    
  global $conn;
  $sql="SELECT COUNT(*) FROM posts";
  $stmt=$conn->query($sql);
  $totalrows=$stmt->fetch();
  $totalposts=array_shift($totalrows);
  echo $totalposts;
   
}
function totalcategories(){
  global $conn;
  $sql="SELECT COUNT(*) FROM category";
  $stmt=$conn->query($sql);
  $totalrows=$stmt->fetch();
  $totalcategories=array_shift($totalrows);
  echo $totalcategories;
}
function totaladmins(){
  global $conn;
  $sql="SELECT COUNT(*) FROM admins";
  $stmt=$conn->query($sql);
  $totalrows=$stmt->fetch();
  $totaladmins=array_shift($totalrows);
  echo $totaladmins;
}
function totalcomments(){
  global $conn;
  $sql="SELECT COUNT(*) FROM category";
  $stmt=$conn->query($sql);
  $totalrows=$stmt->fetch();
  $totalcategories=array_shift($totalrows);
  echo $totalcategories;
}
function approvecommentsaccordingtopost($postid){
  global $conn; 
  $sqlapprove="SELECT COUNT(*) FROM comments WHERE post_id='$postid' AND status='ON'";
  $stmtapprove=$conn->query($sqlapprove);
  $datatrows=$stmtapprove->fetch();
  $total=array_shift($datatrows);
  return $total;
}
function disapprovecommentsaccordingtopost($postid){
  global $conn; 
  $sqldisapprove="SELECT COUNT(*) FROM comments WHERE post_id='$postid' AND status='OFF'";
  $stmtdisapprove=$conn->query($sqldisapprove);
  $datatrows=$stmtdisapprove->fetch();
  $total=array_shift($datatrows);
  return $total;
}

?>