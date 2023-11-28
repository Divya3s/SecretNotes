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
    <title>SecretNotes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>

    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .menu {column-width:600px;}
    </style>
</head>
<body>
    <img src="img/logo2.png">
    <h4 class="my-5">Hello <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to Your Secret Notes Diary.</h4>
    <b><?php // Return date/time info of a timestamp; then format the output
                $mydate=getdate(date("U"));
                echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
                
        ?></b>
    <br/><br/>
        
        <a href="reset.php" class="btn btn-outline-secondary">Reset Password</a>
        <a href="logout.php" class="btn btn-outline-secondary">Sign Out</a>
    
    <div class="container mb-3 mt-3">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <td>
                        <div class="menu ">
                            <a href="notes/notes.php" class="btn btn-outline-secondary">Manage Personal Notes</a>
                        </div>
                    </td>
                    <td>
                        <b>Write Private Notes</b>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="menu ">
                            <a href="blogs/blogs.php" class="btn btn-outline-secondary">Manage Blogs</a>
                        </div>
                    </td>
                    <td>
                        <b>Write Public Articles</b>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="menu ">
                            <a href="forum/topic.php" class="btn btn-outline-secondary">Manage Topic Forums</a>
                        </div>
                    </td>
                    <td>
                        <b>Public Forum Discussion</b>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="menu ">
                            <a href="list/list.php" class="btn btn-outline-secondary">Manage Lists</a>
                        </div>
                    </td>
                    <td>
                        <b>Personal Shopping List</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="menu ">
                            <a href="bookmark/bookmark.php" class="btn btn-outline-secondary">Manage Bookmarks</a>
                        </div>
                    </td>
                    <td>
                        <b>Personal bookmark Collection</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="menu ">
                            <a href="contact/contact.php" class="btn btn-outline-secondary">Manage Contacts</a>
                        </div>
                    </td>
                    <td>
                        <b>Personal contact Book</b>
                    </td>
                   
                </tr>
                <tr>
                    <td>
                        <div class="menu ">
                            <a href="todo/thingstodo.php" class="btn btn-outline-secondary">Manage To Do list</a>
                        </div>
                    </td>
                    <td>
                        <b>Personal To Do Task List</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="menu ">
                            <a href="routine/routines.php" class="btn btn-outline-secondary">Manage Routines</a>
                        </div>
                    </td>
                    <td>
                        <b>Personal Class Routine</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="menu ">
                            <a href="calculator/calculator.php" class="btn btn-outline-secondary">Calculator</a>
                        </div>
                    </td>
                    <td>
                        <b> Calcilator App</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </br> </br> </br> </br> </br>

    <!-- .....................scripts........................ -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

   
</body>
</html>


