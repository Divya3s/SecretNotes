<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
    }
    
    include_once('../config.php');
$aid = $_GET['aid'];

//fetch data from article table
$sql ='SELECT * FROM article WHERE aid = :aid';
$stmt = $pdo->prepare($sql);
$stmt->execute([':aid'=> $aid]);
$article = $stmt->fetchAll(PDO::FETCH_OBJ);
$article = $article[0];
//var_dump($article);



//get username who has written the article
$aid = $_GET['aid'];

$sql2 = 'SELECT users.username FROM users where users.id IN ( SELECT article.id FROM article WHERE article.aid = :aid )';
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([':aid'=> $aid]);
$username = $stmt2->fetchAll(PDO::FETCH_OBJ);
$username = $username[0];
$username = $username->username;
//var_dump($username);

 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article: <?php echo $article->title; ?> </title>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=60d726330dbb3e00121e24be&product=inline-share-buttons" async="async"></script>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sn.css">
    
</head>
<body>
<a href="../index.php"><img src="../img/logo2.png"/><br/></a>
    <div class="wrapper2" id="note">
    
    <!-- <?php echo htmlspecialchars($_SESSION["username"]);?> -->
    
    <label><h3>Composed by </label><b><?php echo $username;?></h3></b>
    <div class ="narticle"><p><u><h4><?= $article->title; ?></h4></u></p><br/><br/><br/>
    <p><?= $article->article;?></p></div><br/><br/>
    <p><?= $article->created;?></p></div><br/><br/>
    <div class="sharethis-inline-share-buttons"></div><br/><br/>
    <a href="blogs.php" class="btn btn-outline-secondary">Back</a>         
    </div>
   
</body>
 