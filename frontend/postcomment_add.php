<?PHP
session_start();
$username= $_SESSION['username'];

include('../Backend/dbconnect.php');

$pid= $_GET['pid'];
$pc_content = $_POST['pc_content'];


  $sql = "SELECT c.id FROM credentials cr, customer c WHERE c.c_fk_crid=cr.id AND cr_username = '$username'";
  $result = $conn->query($sql);
  if($result -> num_rows>0){
      while($row = $result->fetch_assoc()){
        $cid = $row['id'];
      }
      $sql = "INSERT INTO Postcomment(pc_content,pc_date, pc_fk_cid, pc_fk_pid) VALUES (
      '$pc_content', now(), $cid, '$pid')";
    $conn->query($sql);
  }
  
  echo "<meta http-equiv='refresh' content='0 url=customerprofile.php?action=details_post&pid=".$pid."'>";
?>