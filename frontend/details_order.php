<?PHP
$oid= $_GET['oid'];

$sql = "SELECT op.*, m.m_name, m.m_price from ordering o, orderposition op, meal m WHERE op.op_fk_oid=o.id AND op.op_fk_mid=m.id AND op.op_deleted=0 AND o.id=$oid AND op.op_amount>0 ORDER BY op.id ASC;";
$result = $conn->query($sql);
	
?>
<html>
	<head>
		<style>
			.table td {
				border-bottom: 1px solid maroon;
			}
			.table th {
				border-bottom: 2px solid maroon;
			}
			.section a button {
				border: 2px solid maroon!important;
				background-color: #fff!important;
				padding: 5px 5px;
			}
			.section a button:hover {
				background-color: maroon!important;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<div class='section'>
			<table class='table'>
				<tr>
					<th> # </th>
					<th> Item </th>
					<th> Quantity </th>
					<th> Price </th>
				</tr>
	
<?PHP

if($result->num_rows>0){
	$i=1;
	$sum=0;
	while($row = $result->fetch_assoc()){
		echo "
			<tr>
				<td> $i </td>
				<td> ".$row['m_name']." </td>
				<td> ".$row['op_amount']." </td>
				<td> ".$row['m_price']." </td>
			</tr>
		";
		$sum+=$row['op_amount']*$row['m_price'];
	}
	echo "
		<tr>
			<td colspan='3'> Total </td>
			<td> $sum </td>
		</tr>
	";
} else {
	echo "
		<tr>
			<td colspan='4'> You haven't ordered anything right now. </td>
		</tr>
	";
}

?>
			</table>
		</div>
		<div class='section'>
			<a href='customerprofile.php?action=overview_order'><button> Back </button></a>
		</div>
	</body>
</html>
