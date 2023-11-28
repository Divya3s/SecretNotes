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
    <title>Bookmarks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <!-- <link rel="stylesheet" href="../css/sn.css"> --> 
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .t {column-width:400px;}
    </style>
</head>
<body>
<a href="../index.php"><img src="../img/logo2.png"/><br/></a>
    <h4 class="my-5">Hello <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to Your web link collection.</h4>
    <b><?php // Return date/time info of a timestamp; then format the output
                $mydate=getdate(date("U"));
                echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
                
        ?></b>
    <br/><br/>
        <a href="addbookmark.php" class="btn btn-outline-secondary">Add new Bookmark, Link or URL</a>
        <a href="../index.php" class="btn btn-outline-secondary">DashBoard</a>
    
    <div class="container mb-3 mt-3">
        <table class="table table-hover" id ="mydatatable">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col" class="t">Bookmark Title</th>
                <th scope="col">Date</th>
                <th scope="col">Visit</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <!-- <th scope="col">Actions</th> -->
                </tr>
            </thead>
            <tbody>
            
            <?php
                include_once('../config.php');
                $i = 1;
                $id = $_SESSION['id'];
                $sql ='SELECT * FROM bookmark WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                $bookmark = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                   
                foreach($bookmark as $bookmark): 
               
                ?>
            
                <tr>
                    <td><?= $i++;?></td>
                    <td><b><?= $bookmark->title;?></b></td>
                    <td><?= $bookmark->date;?></td>
                    <td><a href="//<?=$bookmark->url ?>" class="btn btn-outline-secondary" target="_blank">Visit</a></td>
                    <td><a href="editbookmark.php?bid=<?=$bookmark->bid ?>" class="btn btn-outline-secondary">Update</a></td>
                    <td><a href="deletebookmark.php?bid=<?=$bookmark->bid ?>" class="btn btn-outline-secondary" onclick="return confirm('Are you sure You Want to Delete this Bookmark?')">Delete</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <!-- .....................scripts........................ -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script> $(document).ready( function () { $('#mydatatable').DataTable();} );</script>
</body>
</html>


