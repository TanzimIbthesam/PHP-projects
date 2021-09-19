<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
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
         <form action="blog.php"class="form-inline d-none d-sm-block"method="post">
         <div class="form-group">
         <input type="text" name="" id=""class="form-control mr-2"placeholder="Search here">
         <button class="btn btn-primary"name="searchbutton">Go</button>
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
        <h1>The Complete Responsive CMS BLOG</h1>
        <h1 class="lead">The Complete Responsive CMS BLOG</h1>
        <?php global $conn; 
        $sql="SELECT * FROM posts ORDER BY id desc";
        $stmt=$conn->query($sql);
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
        <small class="text-muted">Written by <?php echo $admin; ?> on <?php echo htmlentities($datetime); ?></small>
        <span class="badge badge-dark text-light"style="float:right">Comments</span>
        
        <p class="card-text"><?php if(strlen($postdesc)>150){
         $postdesc=substr($postdesc,0,150)."...";
         echo htmlentities($postdesc);
        };?></p>
        <a href="fullpost.php" style="float:right"><span class="btn btn-info">Read More>></span></a>
        
        </div>
        </div>
      <?php  }?>
        </div>
        <!-- Main-Area End -->
        <!-- Side Area Start -->
        <div class="col-sm-4">
        
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