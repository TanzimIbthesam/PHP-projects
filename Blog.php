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
    <link rel="stylesheet" href="css/mystyle.css">
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
          <a href="blog.php?page=1"class="nav-link">Blog</a>
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
        <h1>The Complete Responsive CMS BLOG</h1>
        <h1 class="lead">The Complete Responsive CMS BLOG</h1>
        <?php 
        echo ErrorMessage(); 
        echo SuccessMessage();
        ?>
        <?php 
        //SQL query when search button is active
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
          //query when pagination is active ie blog.php?page=1
        }elseif(isset($_GET["page"])){
         $page=$_GET["page"];
         if($page==0 or $page<1){
          $showpostfrom=0;
         }else{
          $showpostfrom=($page*4)-4;
         }
         
         $sql="SELECT * FROM posts ORDER BY id desc LIMIT  $showpostfrom,4";
         $stmt=$conn->query($sql);
        }
        //Query when category is active
        elseif(isset($_GET['category'])){
         $category=$_GET['category'];
         $sql="SELECT * FROM posts WHERE category='$category' ORDER BY id desc";
         $stmt=$conn->query($sql);
       

        }
        else{ 
        $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
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
        <small class="text-muted">
        Category:<span class="text-dark"><a href="blog.php?category=<?php echo $category;?>"><?php echo $category;?></a></span>
        Written by <span class="text-dark"><a href="profile.php?username=<?php echo htmlentities($admin);?>" target="_blank" ><?php echo htmlentities($admin);?></a></span> on <span class="text-dark"><?php echo htmlentities($datetime); ?></span> </small>
        <span class="badge badge-dark text-light"style="float:right">Comments:<?php echo approvecommentsaccordingtopost($postid);?></span>
        
        <p class="card-text">
       
        <?php if(strlen($postdesc)>150){$postdesc=substr($postdesc,0,150).'..';} 
            //echo htmlentities($postdesc)//creating problem when there is apostohe s;
            echo $postdesc;
            ?>
        <a href="fullpost.php?id=<?php echo $postid; ?>" style="float:right"><span class="btn btn-info">Read More>></span></a>
        
        </div>
        </div>
      <?php  }?>
      <!-- Pagination Start -->
      <nav class="pt-2">
      <ul class="pagination pagination-lg">
      <?php
      if(isset($page)){
          if($page>1){ 
          ?>
          <li class="page-item">
      <a href="blog.php?page=<?php echo $page-1; ?>"class="page-link">&laquo;</a>
      </li>  
          <?php  } }
        ?>
      <?php 
       global $conn;
       $sql="SELECT COUNT(*) FROM posts";
       $stmt=$conn->query($sql);
       $rowpagination=$stmt->fetch();
       $totalposts=array_shift( $rowpagination);
      //  echo $totalposts."<br>";
       $postpagination=$totalposts/4;
       $postpagination=ceil($postpagination);
      //  echo $postpagination;
       for ($i=1; $i <=$postpagination ; $i++){ 
         if(isset($page)){
         if($i==$page) { ?>
         <li class="page-item active">
      <a href="blog.php?page=<?php echo $i; ?>"class="page-link"><?php echo $i;?></a>
      </li> 
      <?php
      }else{ 
       ?>
      <li class="page-item">
      <a href="blog.php?page=<?php echo $i; ?>"class="page-link"><?php echo $i;?></a>
      </li> 
      <?php }
         } }  ?>
        <!-- Creating Forward Page -->
        <?php 
        if(isset($page) && !empty($page)){
          if($page+1<=$postpagination){ 
          ?>
          <li class="page-item">
      <a href="blog.php?page=<?php echo $page+1; ?>"class="page-link">&raquo;</a>
      </li>  
        
        <?php } }?>
      </ul>
      </nav>
      
        </div>
        <!-- Main-Area End -->
        <!-- Side Area Start -->
        <div class="col-sm-4">
        <div class="card mt-4">
          <div class="card-body">
          <img src="img/blog.png"class="d-block img-fluid mb-3" alt="">
          <div class="text-center">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta explicabo labore corrupti voluptates aliquam earum dignissimos nostrum, odio veniam temporibus aspernatur suscipit, illo obcaecati tenetur dolorum dolore consequuntur ratione exercitationem eligendi. Reiciendis quas, architecto dolorem non tenetur error natus ab doloribus reprehenderit voluptatem odio, repellat delectus odit quam unde consequuntur.
          </div>
          </div>
        </div>
        
        
        <br>
        <div class="card">
        <div class="card-header bg-dark text-light">
        <h2 class="lead">Sign Up</h2>
        </div>
        <div class="card-body">
      <button class="btn btn-success btn-block text-center text-white" name="button">Join The Forum</button>
      <button class="btn btn-danger btn-block text-center text-white" name="button">Login</button>
      <div class="input-group mb-3 mt-3">
      <input type="text"class="form-control"name=""placeholder="Enter Your Email"value="">
        <div class="input-group-append">
        <button type="button"class="btn btn-primary btn-sm text-center text-white"name="button">Subscribe</button>
        </div>
      </div>
        </div>
        </div>
        <br>
        <div class="card">
        <div class="card-header bg-dark text-white  ">
        <h2 class="lead">Categories</h2>
        </div>
        <div class="card-body  text-white">
        <?php 
         global $conn;
         $sql="SELECT * FROM category ORDER BY id desc";
         $stmt=$conn->query($sql);
       
         while($datarows=$stmt->fetch())
         { 
           $categoryid=$datarows["id"];
           $categoryname=$datarows["title"];
        

        ?>
        <a href="blog.php?category=<?php echo $categoryname; ?>"><span class="heading"><?php echo $categoryname;  ?></span></a>
        <br>
         <?php }
        ?>
        </div>
        </div>
        <br> 
        <div class="card">
          <div class="card-header bg-info text-white">
           <h2 class="lead">
             Posts
           </h2>
          </div>
          <div class="card-body">
            <?php 
            global $conn;
            $sql="SELECT * FROM posts ORDER BY id DESC LIMIT 0,6";
            $stmt=$conn->query($sql);
            while($datarows=$stmt->fetch()){
              $postid=$datarows['id']; 
             $postdatetime= $datarows['datetime'];
             $posttitle=$datarows['title'];
             $postcategory=$datarows['category'];
             $postauthor=$datarows['author'];
             $postimage=$datarows['image'];
             $postdesc=$datarows['post'];
            ?>
            <div class="media">
              <img src="uploads/<?php echo htmlentities($postimage); ?>"class="img-fluid d-block align-self-start mb-2" alt=""style="width:90px;height: 94px;">
            <div class="media-body ml-2">
            <a href="fullpost.php?id=<?php echo htmlentities($postid); ?>"target="_blank"style="text-decoration:none;color:black;"><h6 class="lead"><?php echo $posttitle; ?></h6></a>
              
              <p class="small"><?php echo htmlentities($postdatetime);  ?></p>
            </div>
            </div>
            <hr>
            <?php }?>
          </div>
        </div>
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
      <div style="height:10px;background:#27aae1"></div> -->
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