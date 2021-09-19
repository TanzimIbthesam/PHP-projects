<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
$_SESSION['TrackingURL']=$_SERVER["PHP_SELF"];
confirm_login();
?>
<?php
//Fetching the existing admin data
$adminid= $_SESSION['userID'];
global $conn;
$sql="SELECT * FROM admins WHERE id='$adminid'"; 
$stmt=$conn->query($sql);
while($datarows=$stmt->fetch()){
  $existingName=$datarows['aname'];
  $existingusername=$datarows['username'];
  $existingheadline=$datarows['aheadline'];
  $existingbio=$datarows['abio'];
  $existingimage=$datarows['aimage'];

}
if (isset($_POST['Submit'])) {
    $aname=$_POST['name'];
    $aheadline=$_POST['Headline'];
    $abio=$_POST['Bio'];
    $image=$_FILES['image']['name'];
    $target="img/".basename($_FILES['image']['name']);
   
    
    date_default_timezone_set("Asia/Dhaka");
    $currentTime=time();
    $datetime=strftime("%B-%d-%y %H:%M:%S",$currentTime);

   if(strlen($aheadline)>40){
        $_SESSION['ErrorMessage']="Headline should be greater than 40 characters";
        redirect_to("myprofile.php");
      }elseif(strlen($abio)>500){
        $_SESSION['ErrorMessage']="Bio should be less than 500 characters";
        redirect_to("myprofile.php");
    }
    else{ 
        //Update admins information
        global $conn;
        if(!empty($image)){ 
        $sql="UPDATE admins
        SET aname='$aname', aheadline='$aheadline',abio='$abio',aimage='$image'
        WHERE id='$adminid'";
       
            }else{
             $sql= "UPDATE admins
              SET aname='$aname', aheadline='$aheadline',abio='$abio'
              WHERE id='$adminid'";
            }
            $execute=$conn->query($sql);
            move_uploaded_file($_FILES["image"]["tmp_name"],$target);

       
        if($execute){
            $_SESSION['SuccessMessage']='Details Updated successfully';
            
            redirect_to('myprofile.php');
        }else{
            $_SESSION['ErrorMessage']="Something went wrong try again";
        redirect_to('myprofile.php');
        }
        
    }
}



?>
<!doctype html>
<html lang="en">
  <head>
    <title>My Profile</title>
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
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark  ">
      <div class="container"style="">
        
      <a href="#"class="navbar-brand">CMS </a>
      <button class="navbar-toggler"data-toggle="collapse"data-target="#navbarCollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse"id="navbarCollapseCMS">
      <ul class="navbar-nav mr-auto text-white">
        
        <li class="nav-item">
          
          <a href="myprofile.php"class="nav-link"><i class="fas fa-user text-success"></i>Profile</a>
        </li>
        <li class="nav-item">
          <a href="Dashboard.php"class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="Posts.php"class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
          <a href="Categories.php"class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
          <a href="Admin.php"class="nav-link">Manage Admin</a>
        </li>
        <li class="nav-item">
          <a href="Comments.php"class="nav-link">Comments</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1"class="nav-link">Live Blog</a>
        </li>
        
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="Logout.php"class="nav-link"><i class="fas fa-user-times text-danger"></i>Logout</a>
        </li>
      </ul>
    </div>
      </div>
      
      </nav>
      <div style="height:10px;background:#27aae1"></div>
      <!-- navbar end -->
      <header class="bg-dark text-white py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <h1><i class="fas fa-user mr-2"style="color:yellow;"></i>@<?php echo $existingusername; ?></h1>
                <small><?php echo $existingheadline; ?></small>
                
            </div>
            
          </div>
        </div>
          
        </header>
        <!-- header end -->
        <!-- Main Area  -->
       <section class="container py-2">
           <div class="row">
           <!-- Left Area -->
           <div class="col-md-3">
          
           <div class="card">
             <div class="card-header bg-dark text-light">
             <h4><?php echo $existingName; ?></h4>
             </div>
             <div class="card-body">
             <img src="img/<?php echo $existingimage; ?>"class="block img-fluid mb-2" alt="">
             <div class="text">
              <?php echo $existingbio; ?>
             </div>
             </div>
           </div>
           </div>
           <!-- Right Area -->
             <div class="col-md-9"style="min-height:400px">
             <?php echo ErrorMessage(); ?>
             <?php echo SuccessMessage();  ?>
             
               <form action="myprofile.php?id=<?php echo $adminid; ?>" method="post"enctype="multipart/form-data">
                   <div class="card bg-dark text-light">
                      <div class="card-header bg-secondary text-light">
                      <h4>Edit Profile</h4>
                      </div>
                       <div class="card-body bg-dark">
                       <div class="form-group">
                       <input class="form-control"type="text"name="name"
                               id="title"placeholder=""value="<?php echo $existingName; ?>"?>
                       </div>
                           <div class="form-group">
                             <input class="form-control"type="text"name="Headline"
                               id="title"placeholder=""value="<?php echo $existingheadline; ?>">
                               <small class="text-muted">Add a professional Headline.Like developer at XYZ</small>
                               <span class="text-danger">Not More than 30 characters</span>
                           
                           </div>
                           <div class="form-group">
                           
                           <textarea class="form-control"placeholder="Bio" name="Bio" id="post" cols="80" rows="8"value=""><?php echo $existingbio; ?></textarea>
                           </div>
                           <div class="form-group">
                               
                               <div class="custom-file">
                               <input class="custom-file-input"type="File"name="image"id="imageselect"value="">
                               <label for="imageselect"class="custom-file-label">Select Image</label>
                               </div>
                              
                           </div>
                           
                           <div class="row">
                           <div class="col-lg-6 mb-2">
                               <a href="dashboard.php"class="btn btn-warning  btn-block"><i class="fas fa-arrow-left"></i>Back to DashBoard</a>
                           </div>
                           <div class="col-lg-6 mb-2">
                               <button type="submit" class="form-control btn btn-success"name="Submit"><i class="fas fa-check"></i>Update</button>
                           </div>
                           </div>
                       </div>
                   </div>
               </form>
             </div>
           </div>
       </section>
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