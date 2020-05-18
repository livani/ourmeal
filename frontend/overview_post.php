<?PHP

$sql = "SELECT p.* from Post p, customer c, credentials cr WHERE p.p_fk_cid=c.id AND c.c_fk_crid=cr.id AND cr.cr_username='$username' AND p.p_deleted=0 ORDER BY p.p_date DESC;";
	$result = $conn->query($sql);

	if($result-> num_rows>0){
		while($row = $result->fetch_assoc()){
	
			echo "
				<div class='width30 w3-third w3-container w3-margin-bottom'>
				
				<img src='../img/".$row['p_content']."' alt='".$row['p_name']."' style='width:100%' class='w3-hover-opacity'>

				<div class='w3-container w3-white'>
					<a href='customerprofile.php?action=details_post&pid=".$row['id']."'>
					 
					".$row['p_name']."
				  </a>
				</div>
			  </div>
			";
		}
	}
		
?>