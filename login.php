<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    $voter = $_POST['voter'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM voters WHERE voters_id = '$voter' AND password = '$password'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Cannot find Student with the ID';
    } else {
        $row = $query->fetch_assoc();
        $_SESSION['voter'] = $row['id'];
    
    }
} else {
    $_SESSION['error'] = 'Input voter credentials first';
}

header('location: index.php');
 ?>