<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
if(isset($_SESSION['userID'])){
  redirect_to("dashboard.php");
}
if(isset($_POST['Submit'])){
  $username=$_POST['username'];
  $password=md5($_POST['password']);
  if(empty($username)||empty($password)){
    $_SESSION['ErrorMessage']="All fields must be fulfilled";
    redirect_to("login.php");
  }else{
    //code for checking username and password from database
    $found_account=login_attemt($username,$password);
    if($found_account){
      
    
     $_SESSION['userID']=$found_account["id"];
     $_SESSION['userName']=$found_account["username"];
     $_SESSION['adminName']=$found_account["aname"];
      $_SESSION['SuccessMessage']="Welcome {$_SESSION['userName']}";
      if (isset($_SESSION["TrackingURL"])) {
        redirect_to($_SESSION["TrackingURL"]);
      }else{
        redirect_to("dashboard.php");
      }
      
    }else{
      $_SESSION['ErrorMessage']="Incorrect username/password";
    redirect_to('login.php');
    }
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>LogIn</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> 
  <body>
    <!-- header -->
     
      <div style="height:10px;background:#27aae1"></div>
      <!-- Navbar -->
     
     
      <!-- navbar end -->
      <header class="bg-dark text-white py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                 <h1><i class="fas fa-text-height"style="color:yellow;"></i>Hello</h1> 
                
            </div>
            
          </div>
        </div>
          
        </header>
        <div style="height:10px;background:#27aae1"></div>
        <!-- header end -->
        <section class="container py-2 mb-4">
         <div class="row">
           <div class="offset-sm-3 col-sm-6"style="min-height:500px;">
           <br><br><br>
           <?php echo ErrorMessage(); ?>
           <?php echo SuccessMessage();  ?>
           <div class="card bg-secondary text-light">
             <div class="card-header">
               <h4>Welcome back!!</h4>
             </div>
             <div class="card-body bg-dark">
               <form class="" action="login.php"method="post">
                 <div class="form-group">
                   <label for="username"><span class="fieldinfo">Username:
                   </span></label>
                     <div class="input-group mb-3">
                     <div class="input-group-prepend">
                       <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>

                     </div>
                   <input type="text"class="form-control"name="username"id="username"value="">
                 </div>
                 </div>
                 <div class="form-group">
                   <label for="password"><span class="fieldinfo">Password:
                   </span></label>
                     <div class="input-group mb-3">
                     <div class="input-group-prepend">
                       <span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>

                     </div>
                   <input type="password"class="form-control"name="password"id="password"value="">
                 </div>
                 </div>
                 <input type="submit"class="btn btn-info btn-block"name="Submit"id="password"value="Login">
               </form>

             </div>
           </div>

           </div>
         </div>
         
        </section>
        <br>
      <footer class="bg-dark text-white">
       <div class="container">
         <div class="row">
           <div class="col">
           <p class="text-center"><span id="year"></span>|CMS &copy| All rights Reserved </p>
           <p class="small text-center">We make Web Application for our clients as per requirements.All contents are our own using  without constent will we considered as a violation of &trade; copyright. &trade;Facebook  </p>
         </div>
       </div>
      </div>
      </footer>
      <div style="height:10px;background:#27aae1"></div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
  </body>
</html>