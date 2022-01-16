<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $sid = $_POST['student_id'];
    $firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$course = $_POST['course'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $filename = $_FILES['photo']['name'];
    if (!empty($filename)) {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
    }



    $sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo, cy) VALUES ('$sid', '$password', '$firstname', '$lastname', '$filename', '$course')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Voter added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: voters.php');
 