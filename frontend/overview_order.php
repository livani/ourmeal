<?PHP

$sql = "SELECT DISTINCT o.*, r.r_name from ordering o, orderposition op, customer c, credentials cr, restaurant r, meal m WHERE o.o_fk_cid=c.id AND c.c_fk_crid=cr.id AND cr.cr_username='$username' AND op.op_fk_oid=o.id AND op.op_fk_mid=m.id AND m.m_fk_rid=r.id AND o.o_deleted=0 ORDER BY o.o_date DESC;";
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
			.table button {
				border: 2px solid maroon!important;
				background-color: #fff!important;
				padding: 5px 5px;
			}
			.table button:hover {
				background-color: maroon!important;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<table class='table'>
			<tr>
				<th> # </th>
				<th> Order ID </th>
				<th> Date </th>
				<th> Restaurant </th>
				<th> Status </th>
				<th> Action </th>
			</tr>
	
<?PHP

if($result->num_rows>0){
	$i=1;
	while($row = $result->fetch_assoc()){
		$oid= $row['id'];
		echo "
			<tr>
				<td> $i </td>
				<td> $oid </td>
				<td> ".$row['o_date']." </td>
				<td> ".$row['r_name']." </td>
				<td> ".$row['o_status']."</td>
				<td> <a href='customerprofile.php?action=details_order&oid=$oid'><button> Details </button></a></td>
			</tr>
		";
	}
} else {
	echo "
		<tr>
			<td colspan='4'> You haven't ordered anything right now. </td>
		</tr>
	";
}

?>
		</table>
	</body>
</html>