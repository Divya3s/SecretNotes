<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $pwdhint = "";
$username_err = $email_err = $password_err = $confirm_password_err = $pwdhint_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Validate username
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } 
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
    {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } 
    else
    {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                if($stmt->rowCount() == 1)
                {
                    $username_err = "This username is already taken.";
                } 
                else
                {
                    $username = trim($_POST["username"]);
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
                if($stmt->rowCount() == 1)
                {
                    $email_err = "This email is already Exists. Please login";
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
    
    // Validate password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";     
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // validate password hint
    if(empty(trim($_POST["pwdhint"])))
    {
        $pwdhint_err = "Please enter a password Hint this will help to recover your password.";     
    }
    else
    {
        $pwdhint = trim($_POST["pwdhint"]);
    } 

    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($pwdhint_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, email, pwdhint) VALUES (:username, :password, :email, :pwdhint)";
         
        if($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":pwdhint", $param_pwdhint, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_pwdhint = $pwdhint;

            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                echo "You have registered successfully";
                // Redirect to login page
                header("location: login.php");
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up Secret Notes</title>
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: auto; }
    </style>
</head>
<body>
    <div class="wrapper">
    <a href="index.php"><img src="img/logo2.png"/><br/></a>
        <br/><br/><br/>
        
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>   
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password Hint</label>
                <input type="text" name="pwdhint" class="form-control <?php echo (!empty($pwdhint_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pwdhint; ?>">
                <span class="invalid-feedback"><?php echo $pwdhint_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-outline-secondary" value="Submit">
                <input type="reset" class="btn btn-outline-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
            
            <p><h6>Password Recovery feature is currently unavailable, so note down your Password! </h6></p>
        </form>
    </div>    
</body>
</html>