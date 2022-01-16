<?php 
include 'includes/session.php';

if(isset($_POST['delete'])){
  $id = $_POST['id'];
  $sql = "DELETE FROM party_list WHERE id = '$id'";
  if($conn->query($sql)){
      $_SESSION['success'] = 'Partylist Deleted Successfully';
      
  }else{
      $_SESSION['error'] = $conn->error;

  }
}
header("location:partylist.php");
?>