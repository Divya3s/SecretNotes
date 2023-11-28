<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}

    require '../config.php';
    $msg = 'Bookmark saved successfully';


     // get random bid function start
     $n=20;
     function getRandomString($n) {
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $randomString = '';
       
         for ($i = 0; $i < $n; $i++) {
             $index = rand(0, strlen($characters) - 1);
             $randomString .= $characters[$index];
         }
       
         return $randomString;
     }
       
     /// random nid function end
     
    if(isset($_POST['title']) && isset($_POST['url']))
    {
        $id = $_SESSION['id']; 
        $date = date("y/m/d h:i:s a", time());
        $title = $_POST['title'];
        $url = $_POST['url'];
        $bid = $id . getRandomString($n);
        $sql = 'INSERT INTO bookmark( bid, id, title, url, date) VALUES( :bid, :id, :title, :url, :date)';
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([':bid' => $bid,':id' => $id,':title' => $title, ':url' => $url, ':date' => $date]))
        {
            echo $msg;

        }
        else 
           {echo $date;}
    
    }

?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add new Bookmark</title>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="../css/sn.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
             font: 14px sans-serif; text-align: center; 
            }
        .wrapper{
             padding: 20px; margin: auto; width: 80%;
            }
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
</br></br>
        
    
    <div id="note" class="col-auto justify-content-md-centre">
        
        <br/>
        
        
        <form method="post">
        

            <h5>New Bookmark is being saved By <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h5><br/>             
            <input type="text" class="form-control" name="title" id="title" required="required" placeholder="Type Title of URL!" /><br/><br/>
            
            <textarea style="width = 100px" cols="3" class="form-control" required="required" placeholder="Type URL!" name="url" id="url"></textarea><br/><br/>
            
            <input type="submit" class="form-control btn btn-outline-secondary" value=" Save " name="submit"/>
            <input type="cancel" onclick="javascript:window.location='bookmark.php';" class="form-control btn btn-outline-secondary" value=" Back " name="submit"/>
            
            <br /><br /><br />
        </form>
</div>




</body>
</html>
