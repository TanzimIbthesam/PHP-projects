<?php 
require_once ("includes/DB.php");
require_once ("includes/Functions.php");
require_once ("includes/Sessions.php");

$_SESSION['TrackingURL']=$_SERVER["PHP_SELF"];
confirm_login();
?>
<?php 
if (isset($_POST['Submit'])) {
    $username=$_POST['username'];
    $name=$_POST['name'];
    $password=md5($_POST['password']);
    $confirmpassword=md5($_POST['confirmpassword']);
    $admin=$_SESSION['userName'];
    date_default_timezone_set("Asia/Dhaka");
    $currentTime=time();
    $datetime=strftime("%B-%d-%y %H:%M:%S",$currentTime);
   
    if(empty($username)||empty($password)||empty($confirmpassword)){
        $_SESSION['ErrorMessage']="All fields must be fulfilled";
        redirect_to("admins.php");
    }elseif(strlen($password)<4){
        $_SESSION['ErrorMessage']="Password must be greater than 3 characters";
        redirect_to("admins.php");
      
    }elseif($password !==$confirmpassword){
        $_SESSION['ErrorMessage']="Password and confirm password must match";
        redirect_to("admins.php");
    }elseif(CheckUserNameExistsOrNot($username)){
      $_SESSION['ErrorMessage']="Username exists.Try Another One";
        redirect_to("admins.php");
    } else{
        //Query to Insert new Admin in DB when everything is fine
        global $conn;
        $sql="INSERT INTO admins(datetime,username,password,aname,addedby)";
        $sql.="VALUES(:dateTime,:userName,:password,:aName,:adminName)";
        $stmt=$conn->prepare($sql);
        
        $stmt->bindValue(':dateTime',$datetime);
        $stmt->bindValue(':userName',$username);
        $stmt->bindValue(':password',$password);
        $stmt->bindValue(':aName',$name);
        $stmt->bindValue(':adminName',$admin);
        $execute=$stmt->execute();

        if($execute){
            $_SESSION['SuccessMessage']='New Admin Added successfully';
            redirect_to('admins.php');
            // $_SESSION['SuccessMessage']='Category with id'.$conn->lastInsertId().'added successfully';
        }else{
            $_SESSION['ErrorMessage']="Something went wrong try again";
        redirect_to('admins.php');
        }
        
    }
}



?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
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
          <a href="admins.php"class="nav-link">Manage admins</a>
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
          <a href="logout.php"class="nav-link"><i class="fas fa-user-times text-danger"></i>Logout</a>
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
                <h1><i class="fas fa-edit"style="color:yellow;"></i>Manage Admins</h1>
                
            </div>
            
          </div>
        </div>
          
        </header>
        <!-- header end -->
        <!-- Main Area  -->
       <section class="container py-2">
           <div class="row">
             <div class="offset-lg-1 col-lg-10"style="min-height:400px">
             <?php echo ErrorMessage(); ?>
             <?php echo SuccessMessage();  ?>
               <form action="admins.php"method="post">
                   <div class="card bg-secondary text-light">
                       <div class="card-header">
                           <h1>Add new Admin</h1>
                       </div>
                       <div class="card-body bg-dark">
                           <div class="form-group">
                               <label for="username"><span class="fieldinfo">Username:</span></label>
                               <input class="form-control"type="text"name="username"
                               id="username">
                           </div>
                           <div class="form-group">
                               <label for="title"><span class="fieldinfo">Name:</span></label>
                               <input class="form-control"type="text"name="name"
                               id="name">
                               <small class="text-warning text-muted">Optional</small>
                           </div>
                           <div class="form-group">
                               <label for="password"><span class="fieldinfo">Password:</span></label>
                               <input class="form-control"type="password"name="password"
                               id="password">
                           </div>
                           <div class="form-group">
                               <label for="confirmpassword"><span class="fieldinfo">Confirm password:</span></label>
                               <input class="form-control"type="password"name="confirmpassword"
                               id="confirmpassword">
                           </div>
                          

                           <div class="row">
                           <div class="col-lg-6 mb-2">
                               <a href="dashboard.php"class="btn btn-warning  btn-block"><i class="fas fa-arrow-left"></i>Back to DashBoard</a>
                           </div>
                           <div class="col-lg-6 mb-2">
                               <button type="submit" class="form-control btn btn-success"name="Submit"><i class="fas fa-check"></i>Publish</button>
                           </div>
                           </div>
                       </div>
                   </div>
               </form>
               <h2>Existing Categories</h2>
        <table class="table table-striped table-hover"> 
        <thead class="thead-dark"> 
        <tr>
        <th>No.</th>
        <th>Date&Time</th>
        <th>UserName</th>
        <th>Name</th>
        <th>Created By</th>
        <th>Action</th>
        </tr>
        </thead>
        
        
       
        <?php 
         global $conn;
        //  $sql="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
         $sql="SELECT * FROM admins ORDER BY id desc";
         $execute=$conn->query($sql);
         $srno=0;
         while($datarows=$execute->fetch()){
           $adminid=$datarows['id'];
           $admindatetime=$datarows['datetime'];
            $adminusername=$datarows['username'];
            $adminname=$datarows['aname'];
            $adminaddedby=$datarows['addedby'];
          //  $categorycreator=$datarows['author'];
          //  $commentpostid=$datarows['post_id'];
           $srno++;
         
        
            ?>
        </div>
        </div>
        <tbody>
        <tr>
        <td><?php echo $srno; ?></td>
        
        <td><?php echo htmlentities($admindatetime); ?></td>
        <td><?php echo htmlentities($adminusername); ?></td>
        <td><?php echo htmlentities($adminname); ?></td>
        <td><?php echo htmlentities($adminaddedby); ?></td>
         <!-- <td><//?php echo htmlentities($categoryname); ?></td>
        <td><//?php echo htmlentities($categorycreator); ?></td>  -->
       
        <td><a class="btn btn-danger" href="deleteadmins.php?id=<?php echo $adminid;?>">Delete</a></td>
        
        
        </tr>
        </tbody>
        <?php }?>
        </table>
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