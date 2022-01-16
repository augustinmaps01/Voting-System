<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN party_list ON party_list.id = candidates.party_list_ID LEFT JOIN positions ON positions.id=candidates.position_id WHERE candidates.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>