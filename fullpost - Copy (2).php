<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
$searchqueryparam=$_GET["id"];
?>
<?php 
if (isset($_POST['Submit'])) {
    $name=$_POST['commentername'];
    $email=$_POST['commenteremail'];
    $comment=$_POST['commenterthoughts'];
    $admin="Tanzim";
    date_default_timezone_set("Asia/Dhaka");
    $currentTime=time();
    $datetime=strftime("%B-%d-%y %H:%M:%S",$currentTime);
   
    if(empty($name)||empty($email)||empty($comment)){
        $_SESSION['ErrorMessage']="All fields must be fulfilled";
        redirect_to("fullpost.php?id=$searchqueryparam");
    }elseif(strlen($comment)>500){
        $_SESSION['ErrorMessage']="Comment must not be greater than 500 characters";
        redirect_to("fullpost.php?id=$searchqueryparam");
      }else{
        //Query to Insert comment
        $sql="INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
        $sql.="VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:postidfromURL)";
        $stmt=$conn->prepare($sql);
        
        $stmt->bindValue(':dateTime',$datetime);
        $stmt->bindValue(':name',$name);
        $stmt->bindValue(':email',$email);
        $stmt->bindValue(':comment',$comment);
        $stmt->bindValue(':postidfromURL',$searchqueryparam);

        $execute=$stmt->execute();

        if($execute){
            $_SESSION['SuccessMessage']='Comment Submitted Successfully';
            redirect_to("fullpost.php?id=$searchqueryparam");
            // $_SESSION['SuccessMessage']='Category with id'.$conn->lastInsertId().'added successfully';
        }else{
            $_SESSION['ErrorMessage']="Something went wrong try again";
            redirect_to("fullpost.php?id=$searchqueryparam");
        }
        
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Blog Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> 
   <style> 
 
   </style>
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
          <a href="Blog.php"class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#"class="nav-link">About US</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php"class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#"class="nav-link">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="#"class="nav-link">Features</a>
        </li>
        
        
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
         <form action="Blog.php"class="form-inline d-none d-sm-block">
         <div class="form-group">
         <input type="text" name="Search" id=""class="form-control mr-2"placeholder="Search here">
         <button class="btn btn-primary"name="SearchButton">Go</button>
         </div>
          
         </form>
        </li>
      </ul>
    </div>
      </div>
      
      </nav>
      <div style="height:10px;background:#27aae1"></div>
      <!-- navbar end -->
      <!-- header start -->
      <div class="container">
        <div class="row mt-4">
        <!-- Main-Area -->
        <div class="col-sm-8 "style="">
        <?php echo ErrorMessage(); ?>
        <?php echo SuccessMessage();  ?>
        <h1>The Complete Responsive CMS BLOG</h1>
        <h1 class="lead">The Complete Responsive CMS BLOG</h1>
        <?php 
        global $conn; 
        if(isset($_GET['SearchButton'])){
          $Search=$_GET['Search'];
          $sql="SELECT * FROM posts
          WHERE datetime LIKE :Search
          OR title LIKE :Search
          OR category LIKE :Search
          OR post LIKE :Search";
          $stmt=$conn->prepare($sql);
          $stmt->bindValue(':Search','%'.$Search.'%');
          $stmt->execute();
          
        }else{ 
        $postidfromurl=$_GET['id'];
        if(!isset($postidfromurl)){
            $_SESSION['ErrorMessage']='Bad Request';
            Redirect_to("Blog.php");
        }
        $sql="SELECT * FROM posts WHERE id='$postidfromurl'";
        $stmt=$conn->query($sql);
        }
        // $stmt=$conn->query($sql);
        while($datarows=$stmt->fetch()){
          $postid=$datarows["id"];
          $datetime=$datarows["datetime"];
          $posttitle=$datarows["title"];
          $category=$datarows["category"];
          $admin=$datarows["author"];
          $image=$datarows["image"];
          $postdesc=$datarows["post"];
         
        ?>
        <div class="card">
        
        <img src="uploads/<?php echo htmlentities($image); ?>"style="max-height:350px;"class="img-fluid card-img-top" alt="">
        <div class="card-body">
       
        <h4 class="card-title"><?php echo htmlentities($posttitle); ?></h4>
        <small class="text-muted">Category:<span class="text-dark"><?php echo $category;?></span>
        Written by <span class="text-dark"><?php echo $admin;  ?></span> on <span class="text-dark"><?php echo htmlentities($datetime); ?></span></small>
     
        
        <p class="card-text">
       
        <?php 
            echo $postdesc;
            ?>
        
        
        </div>
        </div>
      <?php  }?>
      <span class="fieldinfo">Comments</span><br><br>
      <!-- Comment Part Start -->
      <!-- Fetching Comment start -->
      <?php 
      global $conn;
      $sql="SELECT * FROM comments WHERE post_id='$searchqueryparam' AND status='ON'";
      $stmt=$conn->query($sql);
      while($datarows=$stmt->fetch()){
        $commentdate=$datarows['datetime'];
        $commentername=$datarows['name'];
        $commentcontent=$datarows['comment'];
      
      ?>
      <div>
     
      <div class="media ">
        <img class="d-block image-fluid align-self-start" src="img/comment.png" alt="">
        <div class="media-body ml-2">
        <h6 class="lead"><?php echo $commentdate;  ?></h6>
         <p class="small"><?php echo $commentername; ?></p>
        <p><?php echo $commentcontent; ?></p> 
        </div>
      </div>
      </div>
      <hr>
      <?php } ?>
      <!-- Fetching Comment end -->
      <div class="">
      <form class=""action="fullpost.php?id=<?php echo $searchqueryparam;?>"method="post">
      <div class="card mb-3">
        <div class="card-header">
        <h3 class="fieldinfo">Share your thoughts about this post.</h3>
        </div>
        <div class="card-body">
        <div class="form-group">
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        </div>
        <input type="text"class="form-control"name="commentername"placeholder="name">
        </div>
        </div>

        <div class="form-group">
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        <input type="email"class="form-control"name="commenteremail"placeholder="email">
        </div>
        </div>
        <div class="form-group">
        <textarea name="commenterthoughts" class="form-control" id="" cols="20" rows="6"></textarea>
        </div>
        <div class="form-group">
        <button type="submit"name="Submit"class="btn btn-primary">Submit</button>
        </div>
        </div>
        </div>
        </form>
      </div>
      
      </div>
       <!-- Comment Part End -->
        </div>
        
        <!-- Main-Area End -->
        <!-- Side Area Start -->
        
        
        </div>
        </div>
        
        </div>
      <!-- Side Area End -->
      

        <!-- header end -->
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