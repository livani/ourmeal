<?PHP
session_start();	

include("../Backend/dbconnect.php");

  $pid = $_GET['pid'];
  $sql = "SELECT * FROM Post WHERE id = '$pid'";
  $result = $conn->query($sql);  
  if($result -> num_rows>0){
    while($row = $result->fetch_assoc()){
       $p_name = $row["p_name"];
       $p_description = $row["p_description"];
       $p_content = $row["p_content"];
       // print_r($row);
    }
  }




// showing

?>	
	<?php
	

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Food Corner Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="all">
<link href="css/owl.theme.css" rel="stylesheet">
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- font -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/SmoothScroll.min.js"></script>
</head>
<body>
  <!-- banner -->
  <div class="banner about-bg">
    <!--header-->
    <div class="header">
      <div class="top-nav">
        <span class="menu"><img src="images/menu.png" alt=""/></span>
                <h1> <img src= "Restaurant-Logo-by-Sean-Farrell.jpg" width= "80" height= "70"> </h1>
                <ul>
                    <li><a href="/project/LoginRegistrationForm/homepage/web/home.php">Home</a></li>             
                    <li><a href="/project/LoginRegistrationForm/customerprofile.php">Profile</a></li>
                </ul>
        <!-- script-for-menu -->
        <script>          
          $("span.menu").click(function(){
            $(".top-nav ul").slideToggle("slow" , function(){
            });
          });
        </script>
        <!-- script-for-menu -->
      </div>
  
    
  </div>
  <!-- //banner -->
  
  <div class="blog">
    <div class="container">
      <div class="agile-blog-grids">
        <div class="col-md-8 agile-blog-grid-left">
          <div class="agile-blog-grid">
            <div class="agile-blog-grid-left-img">
              <a href="single.html"><img class="post-image" src="../uploads/<?php echo $fileToUpload; ?>" </a>
            </div>
            
          
            
            <div class="opinion">
              <h3>Leave Your Comment</h3>
              <form action="#" method="post">
                <input type="text" name="Name" placeholder="Name" required="">
                <input type="text" name="Email" placeholder="Email" required="">
                <textarea name="Message" placeholder="Message" required=""></textarea>
                <input type="submit" value="SEND">
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4 agile-blog-grid-right">
          <div class="categories">
            <h3><?php 
            echo $p_name ?></h3>
            <p>
            <?php
            echo $p_description ?>
            </p>
             <button class= "w3-button w3-white">Order</button> 
              <button class= "w3-button w3-white">Like</button> 
          </div>
         </div>
    </div>
  </div>
  
  <!-- footer -->
  <div class="footer">
    <div class="container">
      <div class="agile-footer-grids">
        <div class="col-md-3 agile-footer-grid">
          <h4>Go to the restaurant Page</h4>
        <div class="col-md-3 agile-footer-grid">
          <h3><button class= "w3-button w3-white">LOGOUT</button> </h3>
        </div>
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //footer -->
  <!-- agileits-copyright -->
  <div class="agileits-copyright">
    <div class="container">
      <p>© 2017. Our Meal </p>
    </div>
  </div>
  <!-- //agileits-copyright -->
</body> 
</html>
<html>

	
  

<?php
?>