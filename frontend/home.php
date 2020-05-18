<?PHP
	//include the DB-Connection
	include("../Backend/dbconnect.php");
	
	
?>

<html>
	<head>
		<style>
			* {
				font-family: arial;
			}
			.search {
				margin: 15px;
			}
			.tile {
				width: 350px;
				height: 350px;
				border: 2px solid maroon;
				margin-left: 15px;
				margin-bottom: 15px;
				float:left
			}
			.image {
				padding-bottom: 20px;
				width: 340px;
				height: 250px;
				border: none;
				margin-left: 5px;
				margin-top: 5px;
				margin-right: 5px;
			}
			.text {
				width: auto;
				height: auto;
				border: none;
				margin-left: 5px;
			}
			.title {
				font-size: 100%!important;
				font-weight: bold;
				width: 96%;
				text-align: center;
				margin-bottom: 20px;
			}
			.city {
				float: left;
			}
			.phone {
				float: right;
				margin-right: 5px;
			}
			a {
				text-decoration: none;
				color: black;
			}
			a::visited {
				text-decoration: none;
				color: black;
			}
		</style>
		<script>
			function searchRestaurant() {
			  // Declare variables 
			  var filter, a, text, i, x;
			  filter= document.getElementById("searchinput").value.toUpperCase();
			  //get every tile (variable "a" is an array)
			  a= document.getElementsByTagName("a");
			  
			  // Loop through all tile divs, and hide those who don't match the search query
			  for (i=0; i<a.length; i++){
				text= a[i].getElementsByClassName("text");
				//for each tile ("a" element), get every text element and search for the value
				for (x=0; x<text.length; x++){
					//if the value is found anywhere, display the element and break. If its not found, hide the element
					if (text[x].innerHTML.toUpperCase().indexOf(filter) > -1) {
						a[i].style.display= "";
						break;
					} else {
						a[i].style.display= "none";
					}	
				}
			  }
			}
		</script>
	</head>
	<body>
		<div class="search">
			<input type='text' id='searchinput' onkeyup='searchRestaurant()' placeholder='Search for restaurant..'>
		</div>
		
		<div>
		

<?PHP
	//Select everything from the restaurant table
	$sql= "SELECT * FROM restaurant";
	$result = $conn->query($sql);
	if ($result->num_rows>0) {
		while ($row = $result->fetch_assoc()) {
			//Get the value for each restaurant here. 
			$r_name= $row['r_name'];
			$r_phone= $row['r_phone'];
			$r_city= $row['r_city'];
			//Print the values for each restaurant with beautiful css here.. Since it's in a while loop, just one time coding is required.
			echo "
			
			<a href='customerprofile.php?action=details_restaurant&r_name=$r_name'> 
				<div class='tile'>
					<section class='tile image'>
						<img src='../img/Restaurant/rest_image.jpg' width=335px;>
					</section>
					<section class='tile text title'>
						$r_name
					 </section>
					 <section class='tile text city'>
						$r_city
					</section>
					<section class='tile text phone'>
						$r_phone
					</section>
				</div>
			</a>
			";
			
			//The "a href" above creates a different link for each restaurant. It will parse the restaurant name via GET-Parameter to the page "overview_restaurant.php"
			//example for a restaurant named mcdonalds: overview_restaurant.php?r_name=mcdonalds'
			//This GET-value can be queried in the overview_restaurant.php to display just the meals from this restaurant
		}
	}
	
	//For the customers it would work in the same way, just query another table, get and display the customer values.
?>
		</div>
	</body>
</html>
