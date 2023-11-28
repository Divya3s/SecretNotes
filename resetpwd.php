<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = "";
$email_err = "";
/* $pwdhint = "";
$pwdhint_err = ""; */

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate email
    if(empty(trim($_POST["email"])))
    {
        $email_err = "Please Enter your email address.";     
    }
     elseif(!preg_match('/^[a-z0-9_.-]*@[a-z0-9_.-]+$/', trim($_POST["email"])))
    {
        $email_err = "Please verify! This is not a valid email address.";
    }  
    else
    {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                if(!$stmt->rowCount() > 0)
                {
                    $email_err = "This email is not Exists. Please Register";
                } 
                else
                {
                    $email = trim($_POST["email"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

        /* // show error if password hint is empty
        if(empty(trim($_POST["pwdhint"])))
        {
            $pwdhint_err = " please Enter Your Password Hint!";
        }        
        else
        {
            $pwdhint = trim($_POST["pwdhint"]);
        } */

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset</title>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: auto;   }
    </style>
</head>
<body>
    <div class="wrapper">
    <a href="index.php"><img src="img/logo2.png"/><br/></a>
        <br/><br/><br/>
        <p><b>Check Your Password Hint</b></p>

        

        <!-- <form action="< ?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Enter your Email ID</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                <br/><br/>
                <!-- <label>Enter your Password Hint</label>
                <input type="text" name="pwdhint" class="form-control < ?php echo (!empty($pwdhint_err)) ? 'is-invalid' : ''; ?>" value="< ?php echo $pwdhint; ?>">
                <span class="invalid-feedback">< ?php echo $pwdhint_err; ?></span> -->
            </div>    
            
            <div class="form-group">
                <input type="submit" name=" " class="btn btn-outline-secondary" value="Reset password">
                <!-- <input type="cancel" name="pwdreset" onclick="javascript:window.location='index.php';" class="btn btn-outline-secondary" value=" Back " name="submit"/> -->
            </div>
        </form>
    </div>
</body>
</html>