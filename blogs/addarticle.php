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
    $msg = 'article posted successfully';


     // get random aid function start
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
       
     ///Processing form data when form is submitted
     
    if(isset($_POST['title']) && isset($_POST['article']))
    {
        $id = $_SESSION['id']; 
        $created = date("y/m/d h:i:s a", time());
        $title = $_POST['title'];
        $article = $_POST['article'];
        $username = $_SESSION['username']; 
        $aid = $id . getRandomString($n);
        $sql = 'INSERT INTO article( aid, id, title, article, username, created) VALUES( :aid, :id, :title, :article, :username, :created)';
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([':aid' => $aid,':id' => $id,':title' => $title, ':article' => $article, ':username' => $username, ':created' => $created]))
        {
            echo $msg;

        }
        else 
           {echo $created;}
    
    }

?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add new Public Article</title>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <script type="text/javascript" src="ckeditor5/src/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sn.css">
    <!-- <style>
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

    </style> -->
</head>
<body>

<div class="wrapper">

<a href="../index.php"><img src="../img/logo2.png"/><br/></a>
</br></br>
        
    
    <div id="note" class="col-auto justify-content-md-centre">
        
        <br/>
        
        
        <form method="post">
        

            <h5>This new Article is being Composed By <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h5><br/>
             
            <input type="text" class="form-control" name="title" id="title" required="required" placeholder="Type Title of Your Article Here!" /><br/><br/>
            
            <textarea class="form-control" name="article" id="article"  placeholder="Type Your Public Article, Story, Thoughts, Any Kind Of Information Here! " rows="10" cols="50"></textarea><br/><br/>
            
            <script>
                ClassicEditor.create( document.querySelector( '#article' ) ).catch( error => {console.error( error );} );
            </script>
            <p>After submitting the Article You Can't Be able to Update or Delete it.</p>
            <!-- <input  onclick="javascript:window.location='viewnote.php';" class="form-control btn btn-outline-secondary" value=" View " name=""/> -->
            <input type="submit" class="form-control btn btn-outline-secondary" value=" Save " name="submit"/>
            <input type="cancel" onclick="javascript:window.location='blogs.php';" class="form-control btn btn-outline-secondary" value=" Back " name="submit"/>
            
            <br /><br /><br />
        </form>
</div>
</body>
</html>
