<?php include 'includes/session.php' ?>
<?php 
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $party  = $_POST['partylist'];

    $sql = "UPDATE party_list SET Partylist = '$party ' WHERE id = '$id'";
    if($conn->query($sql)){
        $_SESSION['success']; 'Party list Updated Successfully';

    }else{
        $_SESSION['error'] = $conn->error;
    }
}
header("location:partylist.php");

?>