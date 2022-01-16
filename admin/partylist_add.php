<?php include 'includes/session.php'; ?>
<?php 

if(isset($_POST['add'])){
    $party = $_POST['partylist'];

    $sql = "INSERT INTO party_list(Partylist)VALUES('$party')";
   if($conn->query($sql)){
       $_SESSION['success'] = "Partylist Succesfully Added";
   }else{
       $_SESSION['error'] = $conn->error;
   }
}
header("location:partylist.php");
?>