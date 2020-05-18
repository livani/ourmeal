<?PHP
session_start();	


include('../Backend/dbconnect.php');

$description = $_POST['description'];
$postname = $_POST['postname'];
$username = $_POST['username'];

//for image upload
	$sql = "SELECT MAX(id) as id FROM post";
	$result = $conn->query($sql);
	if ($result->num_rows==1) {
		while ($row = $result->fetch_assoc()) {
			$maxid= $row['id'];
			$maxid+=1;
		}
	} else
		echo "There is no entry in the database.<br>";
	
	
	$uploaddir = "../img/Post/";
	$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
	$uploadfile= $uploaddir.$maxid.".".$ext;

  $sql = "SELECT c.id FROM credentials cr, customer c WHERE c.c_fk_crid=cr.id AND cr_username = '$username'";
  $result = $conn->query($sql);
  if($result -> num_rows>0){
      while($row = $result->fetch_assoc()){
        $id3 = $row['id'];
      }
      $sql = "INSERT INTO Post(p_name,p_description,p_content,p_date, p_fk_cid) VALUES (
      '$postname', '$description', '$uploadfile', now(), '$id3')";
    $conn->query($sql);
  }

  $target_dir = $_SERVER['DOCUMENT_ROOT']."/project/uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] >50000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile);
		echo $uploadfile;
  }
  
  echo "<meta http-equiv='refresh' content='2 url=customerprofile.php?action=details_post&pid=".$maxid."'>";
?>