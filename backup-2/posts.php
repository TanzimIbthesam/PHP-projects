<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Posts</title>
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
          
          <a href="myprofile.php"class="nav-link"><i class="fas fa-user text-success"></i>My Profile</a>
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
                <h1><i class="fas fa-blog"style="color:yellow;"></i>Blog Posts</h1>
                
            </div>
            <div class="col-lg-3 mb-2">
              <a href="addpost.php"class="btn btn-primary btn-block">
              <i class="fas fa-edit"></i>Add New Post
              </a>
            </div>
            <div class="col-lg-3 mb-2">
              <a href="categories.php"class="btn btn-info btn-block">
              <i class="fas fa-folder-plus"></i>Add New Category
              </a>
            </div>
            <div class="col-lg-3 mb-2">
              <a href="admin.php"class="btn btn-warning btn-block">
              <i class="fas fa-user-plus"></i>Add New Admin
              </a>
            </div>
            <div class="col-lg-3 mb-2">
              <a href="comments.php"class="btn btn-success btn-block">
              <i class="fas fa-check"></i>Approve Comments
              </a>
            </div>
            
          </div>
        </div>
          
        </header>
        <!-- header end -->
        <!-- Main Area Start -->
        <section class="container py-2 mb-2"> 
          <div class="row">
          <div class="col-lg-12">
          <table class="table table-striped table-hover">
          <thead class="thead-dark">
          <tr>
          <th>Slno</th>
          <th>Title</th>
          <th>Category</th>
          <th>Date&Time</th>
          <th>Author</th>
          <th>Banner</th>
          <th>Comments</th>
          <th>Action</th>
          <th>Live Preview</th>
          </tr>
          </thead>
          <?php 
            global $conn;
            $sql="SELECT * FROM posts";
            $sr=0;
            $stmt=$conn->query($sql);
           while ($datarows=$stmt->fetch()) {
             $id=$datarows["id"];
             $datetime=$datarows["datetime"];
             $posttitle=$datarows["title"];
             $category=$datarows["category"];
             $admin=$datarows["author"];
             $image=$datarows["image"];
             $posttext=$datarows["post"];
            $sr++;

           
            ?>
            <tbody>
            <tr>
            <td><?php echo $sr; ?></td>
            <td><?php if(strlen($posttitle)>20){$posttitle=substr($posttitle,0,18).'..';} 
            echo $posttitle;?></td>
            
            <td><?php if(strlen($category)>14){$category=substr($posttitle,0,14).'..';} 
            echo $category;?></td>
            <td><?php echo $datetime; ?></td>
           
            <td><?php if(strlen($admin)>6){$posttitle=substr($posttitle,0,6).'..';} 
            echo $admin;?></td>
           
            <td> <img src="uploads/<?php echo $image;?>"style="width:100px;height:50px"></td>
            <td>Comments</td>
            <td>
           <a href=""class="btn btn-warning btn-sm">Edit</a>
           <a href=""class="btn btn-danger btn-sm">Delete</a>
           
            </td>
            <!-- <a href=""class="btn btn-info btn-sm">Live Preview</a> -->
            <td><a href=""></a>  <a href=""class="btn btn-info btn-sm">Live Preview</a></td>
            </tr>
            </tbody>
          <?php }?>
          
          </table>
          </div>
            
          </div>
        </section>
      <!-- MainArea End -->
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