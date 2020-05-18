<?PHP
	include("../Backend/dbconnect.php");	
	
	if (isset($_GET['change'])){
		if (isset($_GET['item'])){
			$mid= $_GET['item'];
			$quantity= $_SESSION['cart'][$mid]['quantity'];
			if ($_GET['change']=='increment'){
				$quantity+=1;
			} else if ($_GET['change']=='decrement'){
				$quantity-=1;
			}
			unset($_SESSION['cart'][$mid]);
			$_SESSION['cart'][$mid]=array('quantity'=>$quantity);
		}
	}
	
	
?>

<html>
	<head>
		<style>
		table {
	border: 0px!important;
}
.table td {
	border-bottom: 1px solid maroon;
}
.table th {
	border-bottom: 2px solid maroon;
}
.price {
	font-weight: bold;
}
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
.big-button {
	border: 2px solid maroon!important;
	background-color: #fff!important;
	padding: 10px 20px;
}
button:hover {
	background-color: maroon!important;
	color: #fff;
}
.big-button {
	float: right;
}
.small-button{
	width: 20px!important;
	border: 1px solid maroon!important;
	background-color: #fff!important;
	padding: 0px 0px;
	padding: 2px;
	
}
.small-button {
	float: none;
}
		</style>
	</head>
	<body>
	
		<div class='section'>
			<h1> Order Overview </h1>
				<p class="maroon"> Please confirm your order information. </p>
		</div>
	
<?PHP
	
?>
		<div class='section'>
			<h2> Shopping Cart </h2>
			<table class='table'>
				<tr>
					<th> Position </th>
					<th> Name </th>
					<th> Quantity </th>
					<th> Price </th>
				</tr>
<?PHP
	if (isset($_SESSION['cart'])){
		if (count($_SESSION['cart'])>0){
			$ids = array();
			foreach($_SESSION['cart'] as $id=>$value){
				array_push($ids, $id);
			}
			$position=1;
			$sum=0;
			foreach ($ids as $mid) {
				$quantity=$_SESSION['cart'][$mid]['quantity'];
				$sql= "SELECT * FROM meal WHERE m_deleted=0 AND id=$mid;";
				$result = $conn->query($sql);
				if ($result->num_rows>0) {
					while ($row = $result->fetch_assoc()) {
						$m_name= $row['m_name'];
						$m_price= $row['m_price'];
						$m_fk_rid= $row['m_fk_rid'];
					}
				}
				$sum+=$quantity*$m_price;
				echo "
					<tr>
						<td> $position </td>
						<td> $m_name </td>
						<td> 
							<a href='customerprofile.php?action=shoppingcart&change=decrement&item=$mid'><button class='small-button'>-</button></a>
							$quantity
							<a href='customerprofile.php?action=shoppingcart&change=increment&item=$mid'><button class='small-button'>+</button></a> 
						</td>
						<td> $m_price IDR </td>
					</tr>
				";
				$position++;
			}
			echo "
				<tr>
					<td colspan='3'> Total: </td>
					<td class='price'> $sum IDR </td>
				</tr>
			";
		} else {
			echo "
				<tr>
					<td colspan='4'> Your shopping cart is empty.</td>
				</tr>
			";
		}
	} else {
		echo "
			<tr>
				<td colspan='4'> Your shopping cart is empty.</td>
			</tr>
		";
	}
?>
			</table>
		</div>
		
		<div class='section'>
			<h2> Delivery Address </h2>
			
<?PHP
$sql= "SELECT a.*, c.*, cr.cr_email FROM address a, customer c, credentials cr WHERE c.c_deleted=0 AND c.c_fk_aid=a.id AND c.c_fk_crid=cr.id AND cr.cr_username='$username';";
$result = $conn->query($sql);
if ($result->num_rows>0) {
	while ($row = $result->fetch_assoc()) {
		$c_first_name= $row['c_first_name'];
		$c_last_name= $row['c_last_name'];
		$c_phone= $row['c_phone'];
		$cr_email= $row['cr_email'];
		$a_street= $row['a_street'];
		$a_number= $row['a_number'];
		$a_zip= $row['a_zip'];
		$a_city= $row['a_city'];
		$a_country= $row['a_country'];
	}
}

echo "
	<p>$c_first_name $c_last_name </p>
	<p> $a_street $a_number </p>
	<p> $a_zip $a_city </p>
	<p> $a_country </p>
";
?>
			
		</div>
		
		<div class='section'>
			<h2> Contact </h2>

<?PHP
	echo "
		<p> Phone: $c_phone </p>
		<p> E-Mail: $cr_email </p>
	";
?>
			
	</div>

	<div class='section'>
		<a href='customerprofile.php?action=shoppingcart_checkout'><button class='big-button'> ORDER </button></a>
	</div>
		
		
	</body>
</html>