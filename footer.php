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