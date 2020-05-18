<html>
	<head>
		<style>
			.section {
				margin-bottom: 50px;
			}
			.section p {
				margin-left: 20px;
			}
			.section p {
				color: maroon;
				font-size: 20px;
			}
			.section button {
				border: 2px solid maroon!important;
				background-color: #fff!important;
				padding: 10px 20px;
			}
			.section button:hover {
				background-color: #efefef!important;
			}
			.section button {
				float: right;
			}
		</style>
	</head>
	<body>
	

<?PHP
include('../Backend/dbconnect.php');
if (isset($_GET['status']) && $_GET['status']=='success'){
	if (isset($_GET['oref'])){
?>
	<div class='section'>
		<h2> Success </h2>
		<p> 
			Your order has been sent to the restaurant.<br>
			Please note your order reference: <?PHP echo $_GET['oref']; ?>
			<a href='customerprofile.php?action=post'><button> CLOSE </button></a>
		</p>
	</div>
<?PHP
	}
} else if (isset($_GET['status']) && $_GET['status']=='fail'){
?>
	<div class='section'>
		<h2> Oops.. </h2>
		<p> 
			Something went wrong. Please try again later.
			<a href='customerprofile.php?action=post'><button> CLOSE </button></a>
		</p>
	</div>
	
<?PHP
} else {
	if (isset($_SESSION['cart'])){
		
		//Create new order in ordering table
		$sql = "SELECT c.id FROM credentials cr, customer c WHERE c.c_fk_crid=cr.id AND cr_username='$username'";
		$result = $conn->query($sql);
		if($result -> num_rows==1){
			while($row = $result->fetch_assoc()){
				$cid = $row['id'];
			}
			$sql = "INSERT INTO ordering(o_date,o_status,o_fk_cid) VALUES 
					(now(), 'Ordered', '$cid')";
			$conn->query($sql);
		}
		
		//Insert the position in orderposition table
		$sql = "SELECT MAX(id) as id FROM ordering;";
		$result = $conn->query($sql);
		if($result -> num_rows==1){
			while($row = $result->fetch_assoc()){
				$oid = $row['id'];
			}
		}
		$ids= array();
		foreach($_SESSION['cart'] as $id=>$value){
			array_push($ids, $id);
		}
		foreach ($ids as $mid) {
			$quantity=$_SESSION['cart'][$mid]['quantity'];
			$sql = "INSERT INTO orderposition(op_amount,op_fk_mid,op_fk_oid) VALUES 
				('$quantity', '$mid', '$oid');";
			$conn->query($sql);
		}
		unset($_SESSION['cart']); 
		echo "<meta http-equiv='refresh' content='0 url=customerprofile.php?action=shoppingcart_checkout&status=success&oref=$oid'>";
	} else {
		echo "No access";
		echo "<meta http-equiv='refresh' content='2 url=customerprofile.php?action=shoppingcart_checkout&status=fail>";
	}
}  
?>
	</body>
</html>