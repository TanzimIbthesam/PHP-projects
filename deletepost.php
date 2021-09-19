<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");
confirm_login()
?>
<?php 
$seachqueryparam=$_GET['id'];
global $conn;
$searchqueryparam=$_GET['id'];
$sql="SELECT * FROM posts WHERE id= '$searchqueryparam'";
$stmt=$conn->query($sql);
while($datarows= $stmt->fetch()){  
$titletobedeleted=$datarows['title'];
$categorytobedeleted=$datarows['category'];
$imagetobedeleted=$datarows['image'];
$posttobedeleted=$datarows['post'];
}
// echo $imagetobedeleted;
if (isset($_POST['Submit'])) {
        //Query to delete post
        $sql="DELETE FROM posts WHERE id='$searchqueryparam'";
        $execute=$conn->query($sql);
        
       
        if($execute){
             $target_path_to_delete_image="uploads/$imagetobedeleted";
             unlink($target_path_to_delete_image);
            $_SESSION['SuccessMessage']='Post Deleted successfully';
            // $_SESSION['SuccessMessage']='Category with id'.$conn->lastInsertId().'added successfully';
            redirect_to('posts.php');
        }else{
            $_SESSION['ErrorMessage']="Something went wrong try again";
        redirect_to('posts.php');
        }
        
    }




?>
<!doctype html>
<html lang="en">
  <head>
    <title>Delete Post</title>
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
                <h1><i class="fas fa-edit"style="color:yellow;"></i>Delete Post</h1>
                
            </div>
            
          </div>
        </div>
          
        </header>
        <!-- header end -->
        <!-- Main Area  -->
       <section class="container py-2">
           <div class="row">
             <div class="offset-lg-1 col-lg-10"style="min-height:400px">
            
               <form action="deletepost.php?id=<?php echo $searchqueryparam; ?>"method="post"enctype="multipart/form-data">
                   <div class="card bg-secondary text-light">
                      
                       <div class="card-body bg-dark">
                           <div class="form-group">
                               <label for="title"><span class="fieldinfo">Post Title</span></label>
                               <input disabled class="form-control"type="text"name="posttitle"
                               id="title"placeholder="Type title here"value="<?php echo $titletobedeleted; ?>">
                           </div>
                           <div class="form-group">
                          
                            <span class="fieldinfo">Existing Category:</span>
                            <?php echo $categorytobedeleted; ?>
                            
                                
                                  
                             </select>
                           </div>
                           <div class="form-group mb-2">
                           <span class="fieldinfo">Existing image:</span>
                               <img class="mb-2" src="uploads/<?php echo $imagetobedeleted;?>"style="width:100px;height:70px;">
                            <div class="custom-file">
                            <input class="custom-file-input"type="File"name="image"id="imageselect">
                            <label for="imageselect"class="custom-file-label">Select Image</label>
                            </div>
                              
                           </div>
                           <div class="form-group">
                           <label for="post"><span class="fieldinfo">Post</span></label>
                           <textarea disabled class="form-control" name="postdescription" id="post" cols="80" rows="8"value=""><?php echo $posttobedeleted; ?></textarea>
                           </div>
                           <div class="row">
                           <div class="col-lg-6 mb-2">
                               <a href="dashboard.php"class="btn btn-warning  btn-block"><i class="fas fa-arrow-left"></i>Back to DashBoard</a>
                           </div>
                           <div class="col-lg-6 mb-2">
                               <button type="submit" class="form-control btn btn-danger  "name="Submit"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i>Delete</button>
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

    
    if(".deletelink").click(function(){
       return confirm("Are you sure you want to delete?");
    });
    
    </script>
  </body>
</html>