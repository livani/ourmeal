
<?PHP
session_start();

if(isset($_SESSION["username"]) && $_SESSION["username"] != ""){
	$username= $_SESSION['username'];
	$welcome= "Welcome ".$username."!";
	$logout= "<a href='index.php?action=logout'>";
} else {
	header('Location: index.php?action=noaccess');
}
	
include("../Backend/dbconnect.php");

$sql = "SELECT * FROM credentials WHERE cr_username = '$username'";
$sql1 = "SELECT * FROM customer c, credentials cr WHERE c.c_fk_crid=cr.id AND cr.cr_username='$username'";
$result = $conn->query($sql);
$result2 = $conn->query($sql1);
	if ($result2->num_rows>0) {
		while ($row = $result2->fetch_assoc()) {
			//Get the value for each restaurant here. 
			$c_profile_picture= $row ['c_profile_picture'];
			$c_first_name= $row['c_first_name'];
			$c_last_name= $row['c_last_name'];
			$c_gender= $row['c_gender'];
			$c_birth_date= $row['c_birth_date'];
			$c_phone= $row['c_phone'];
			//Print the values for each restaurant with beautiful css here.. Since it's in a while loop, just one time coding is required.
			echo "<img src='$c_profile_picture'>";
			echo "$c_last_name<br>";
			echo "$c_first_name<br>" ; 
			echo "$c_gender<br>";
			echo "$c_birth_date<br>" ; 
			echo "$c_phone<br>";
			} }


?>

<html>
<head>
	<title> Our Meal </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	
	<script type="text/javascript">
    // 1. Listen to click event
    $( document ).ready(function() {

      function togglePopup(){
        console.log("yooo")
        $("#myPopup").toggle();        
      };
      
      $("#togglePopup, .close-pop-up").on('click', togglePopup);

    });
  </script>

</head>

<style>
	body,h1,h2,h3,h4,h5,h6 {
	  font-family: "Raleway", sans-serif
	}
	.title {
		color: grey; 
		font-size: 170%; 
		border-bottom: 6px solid; 
		border-color: maroon; 
		background-color: 
		white
	}
   #logo {
	   margin-bottom: 5px;
   }
   .view {
     height:100%;
   }

   .navbar-brand {
     color:#fff !important;
   }

   .profile-photo {
     width:12px;
     height:12px;
     float: left;
     overflow: hidden;
   }

   .flex-menu {
     display:flex;
   }

   .flex-menu li:not(:last-child) {
     margin-right:40px;
   }
   .btn-circle {
    width: 50px;
    height: 50px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
    float: right;
  }
  #myPopup {
    position: fixed;
    z-index: 1;
    width: 100%;
    top: 0;
    left: 0;
    height: 100%;    
    background: rgba(0,0,0,0.3);
    display: none;
  }
  #myPopup #popup-form {
    z-index: 20;
    position: absolute;
    width: 500px;
    top: 50%;
    background: white;
    left: 50%;
    margin-left: -250px;
    box-shadow: 0 0 6px rgba(0,0,0,0.3);
  }
  .close-pop-up {
    position: absolute;
    color: white;
    top: 10px;
    right: 10px;
    cursor: pointer;
  }
  #link {
	  text-decoration: underline;
	  color: blue;
  }
  .center {
		margin: auto;
		width: 50%;
		margin-bottom: 10px;
		
  }
  .width100 {
	  width: 100%;
  }
  .width30 {
	  width: 30%;
  }
  
</style>
<header>
  <div class = "title">
    <img id="logo" src= "Restaurant-Logo-by-Sean-Farrell.jpg" width= "80" height= "70"> 
    <br>
  </div>
</header>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<div class="w3-container">
	<div>
		<h1 style="float:left;width:100%"> <b> <?PHP echo $welcome; ?> </b> </h1>
		<?PHP echo $logout; ?> <button style="float:right;" class= "w3-button w3-white">Logout</button> </a>
	</div>
	
	<div>
		<a href="customerprofile.php?action=post"> <button class= "w3-button w3-white"><i class="fa fa-home"></i></button> </a>
		<a href="customerprofile.php?action=shoppingcart"><button class= "w3-button w3-white"><i class="fa fa-shopping-cart" ></i></button></a>
	</div>
	
  </h1>
  <div class="w3-section w3-bottombar w3-padding-16"> 
    <a href="customerprofile.php?action=home"> <button class= "w3-button w3-white"> <i class="fa fa-diamond w3-margin-right"></i>Restaurants</button> </a>
	<a href="customerprofile.php?action=overview_order"> <button class= "w3-button w3-white"> <i class="fa fa-diamond w3-margin-right"></i>Order status</button> </a>

        <button type="button" data-rel="popup" id="togglePopup" class="btn btn-default btn-circle"><i class="fa fa-plus"> Post</i></button>





        <div data-role="popup" id="myPopup" class="ui-content" style="width:100%;">
            <img src="../uploads/<?PHP echo $_FILES["fileToUpload"]["name"]; ?>">
            <div data-role="main" class="ui-content"> 
              <div data-role="popup">
                
                <form id="popup-form" action="post_add.php" method="POST" enctype="multipart/form-data">
                  <input type= "file"; name= "fileToUpload"; id="fileToUpload">
                  <br>
                  Name:<br>
                  <input type="text"; name="postname">
                  <br>
                  Description:<br>
                  <input type="text"; name= "description";>
                  <br> 
				  <input type="hidden" name="username" value="<?PHP echo $username; ?>">
                  <input type="submit"; value= "post">
                </form>
				<div class="close-pop-up"><button>Close</button></div>
              </div>
            </div>

          </div>
        </div>
        <main>
          <div class="container">
           <div class="row m-b-r m-t-3">
            <div class="width100 col-md-9">            

<?php
//-----------------------
	
	
	if (isset($_GET['action']) && $_GET['action']=='post') {
		include('overview_post.php');
	}
	if (isset($_GET['action']) && $_GET['action']=='home') {
		include('home.php');
	}
	if ((isset($_GET['action']) && $_GET['action']=='details_restaurant')&&(isset($_GET['r_name']))) {
		include('details_restaurant.php');
	}
	if ((isset($_GET['action']) && $_GET['action']=='details_post')&&(isset($_GET['pid']))) {
		include('details_post.php');
	}
	if ((isset($_GET['action']) && $_GET['action']=='shoppingcart')) {
		include('shoppingcart.php');
	}
	if ((isset($_GET['action']) && $_GET['action']=='shoppingcart_checkout')) {
		include('shoppingcart_checkout.php');
	}
	if ((isset($_GET['action']) && $_GET['action']=='overview_order')) {
		include('overview_order.php');
	}
	if ((isset($_GET['action']) && $_GET['action']=='details_order')&&(isset($_GET['oid']))) {
		include('details_order.php');
	}
	
//-----------------------------------
?>

        
      </div>


      <div class="center">
        <div class="center w3-bar">
          
        </div>
      </div>



      <!-- Footer -->
      <footer class="w3-container w3-padding-32 w3-dark-grey">
        <div class="w3-row-padding">
          <div class="w3-third">
            <h3>OurMeal</h3>
            <p>Discover. Order. Share.</p>
          </div>



        </div>
      </footer>

      <div class="w3-black w3-center w3-padding-24"><i class="fa fa-copyright w3-margin-right"> </i>ourmeal </div>

      <!-- End page content -->
    </div>



  </body>
  </html>
