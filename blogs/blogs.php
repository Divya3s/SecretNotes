<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
    }

    
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/sn.css">
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>

    <!-- <style>
        body{ font: 14px sans-serif; text-align: center; }
        .t {column-width:400px;}
    </style> -->
</head>
<body>
<a href="../index.php"><img src="../img/logo2.png"/><br/></a>
    <h4 class="my-5">Hello <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to Blog Article Section</h4>
    <b><?php // Return date/time info of a timestamp; then format the output
                $mydate=getdate(date("U"));
                echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
                
        ?></b>
    <br/><br/>
        <a href="addarticle.php" class="btn btn-outline-secondary">Add Article</a>
        <a href="../index.php" class="btn btn-outline-secondary">DashBoard</a>
    
    <div class="container mb-3 mt-3">
        <table class="table table-hover" id ="mydatatable">
            <thead>
                <tr>
                <th scope="col">Article No.</th>
                <th scope="col" class="t">Title</th>
                <th scope="col">Written by</th>
                <th scope="col">Date</th>
                <th scope="col">View</th>
                
                </tr>
            </thead>
            <tbody>
            
            <?php
            //fetch data from article table
                include_once('../config.php');
                $i = 1;
                $sql ='SELECT * FROM article ORDER BY created DESC';
                $stmt = $pdo->query($sql);
                $article = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                   
                foreach($article as $article): 
               
                ?>
            
                <tr>
                    <td><?= $i++;?></td>
                    <td><b><?= $article->title;?></b></td>
                    <td><?= $article->username;?></td>
                    <td><?= $article->created;?></td>
                    <td><a href="viewarticle.php?aid=<?=$article->aid ?>" class="btn btn-outline-secondary">View</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <!-- .....................js scripts........................ -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script> $(document).ready( function () { $('#mydatatable').DataTable();} );</script>
</body>
</html>


