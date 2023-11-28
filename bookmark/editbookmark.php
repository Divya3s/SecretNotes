<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
    }
    include_once('../config.php');
    
    $msg = 'Bookmark Updated successfully';
    $bid = $_GET['bid'];
    if(isset($_POST['title']) && isset($_POST['url']))
    {
         
        
        $title = $_POST['title'];
        $url = $_POST['url'];
        $sql = 'UPDATE `bookmark` SET `title` = :title, `url` = :url  WHERE `bookmark`.`bid` = :bid;';
        //$sql = 'UPDATE notes( title, notes) VALUES(:title, :notes)';
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([':title' => $title, ':url' => $url, ':bid' => $bid]))
        {
            echo $msg;

        }

    }

    $sql ='SELECT * FROM bookmark WHERE bid= :bid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':bid'=> $bid]);
    $bookmark = $stmt->fetch(PDO::FETCH_OBJ);

        
?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Bookmark</title>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="../css/sn.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{ padding: 20px; margin: auto; width: 80%;}
        #note {
            border: 1px solid black;
                }

            #notes {
                height: 300px;

            }
            .btn {
                width:150px;
            }

    </style>
</head>
<body>

<div class="wrapper">

<a href="../index.php"><img src="../img/logo2.png"/><br/></a>
       </br> </br>
    
    <div id="note" class="col-auto justify-content-md-centre">
        
        <form method="post">
        
            </br>
            <h5>this Bookmark is being Edited By <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h5><br/>
             
            <input type="text" class="form-control" name="title" id="title" value="<?= $bookmark->title; ?>"/><br/><br/>
            
            <textarea style="width = 100px" cols="3" class="form-control" name="url" id="url"><?= $bookmark->url; ?></textarea><br/><br/>
            
            
            <input type="submit" class="form-control btn btn-outline-secondary" value=" Save "/>
            <input type="cancel" onclick="javascript:window.location='bookmark.php';" class="form-control btn btn-outline-secondary" value=" Back " name="submit"/>
            <br /><br /><br />
        </form>
</div>




</body>
</html>
