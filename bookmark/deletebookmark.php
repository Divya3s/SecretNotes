<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
    }
    include_once('../config.php');
   

    $bid = $_GET['bid'];
    $sql ='DELETE FROM bookmark WHERE bid= :bid';
    $stmt = $pdo->prepare($sql);
    if($stmt->execute([':bid'=> $bid])){
        echo 'Selected Bookmark Deleted Successfully!';
    }
    

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="../css/sn.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
       
    </style>
</head>
<body>

<a href="bookmark.php" class="btn btn-outline-secondary">Back</a>
</body>