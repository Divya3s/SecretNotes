<?php
// Initialize the session
session_start();
 
 
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$pwdhint = "";
$pwdhint_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["pwdhint"])))
    {
        $pwdhint_err = "Please enter your Password hint.";     
    }
    else
    {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE pwdhint = :pwdhint";
        
        if($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":pwdhint", $param_pwdhint, PDO::PARAM_STR);
            
            // Set parameters
            $param_pwdhint = trim($_POST["pwdhint"]);

           
            
        }
        else
        {
                echo "Oops! Something went wrong. Please try again later.";
        }

         // Close statement
        unset($stmt);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Hint</title>
    
    <link rel="shortcut icon" type="image/jpg" href="icon.jpg"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: auto; }
    </style>
</head>
<body>
    <div class="wrapper">
    <img src="img/logo.png"/>
        <br/><br/><br/>
        <h4>Verify Password Hint</h4>
        
        <form action="<?php echo reset.php; ?>" method="post"> 
            <div class="form-group">
                <label>Enter your Password Hint</label>
                <input type="text" name="pwdhint" class="form-control <?php echo (!empty($pwdhint_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pwdhint; ?>">
                <span class="invalid-feedback"><?php echo $pwdhint_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-outline-secondary" value="Submit">
                <input type="cancel" class="btn btn-outline-secondary" value="Cancel" onclick="javascript:window.location='index.php';">
                
            </div>
        </form>
    </div>    
</body>
</html>