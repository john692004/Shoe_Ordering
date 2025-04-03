<?php
session_start();
include('db.php');

if (isset($_POST["login"])){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "SELECT * FROM User WHERE Email = '$email'";
    $execQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($execQuery) != 0){
        if($rows = mysqli_fetch_assoc($execQuery)){
            $role = $rows["Role"];
            $_SESSION["role"] = $role;
            header("location: explorer.php");
        }
    }else{
        header("new.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>

    <style>
      
        body {
            background-image: url(" images (13).jpeg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            color: white;
           
        }

        .form-container {
            background-color: transparent;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            border: 2px solid #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        p {
            text-align: center;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        .show-password {
            display: inline-flex;
            align-items: center;
            margin-top: 0 px;
            text-wrap: nowrap;
        }

        .show-password input {
            margin-right: 0px;
        }

        .show-password > label {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
    
    <a href="index.php" class="exit-Button">Exit</a>
        <h2>Login</h2>
        <?php if (isset($_GET['authfailed'])): ?>
            <div class="error-message">Authentication failed. Please check your credentials.</div>
        <?php endif; ?>

        <?php if (isset($_GET['accountnotfound'])): ?>
            <div class="error-message">Account not found. Please check your details.</div>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <div class="show-password">
            <input type="checkbox" id="showPassword"> <label for="showPassword">Show Password</label>
            </div><br>

            <button type="submit" name="login">Login</button>
        </form>
       
    
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
    <script>
    
    document.getElementById('showPassword').addEventListener('change', function() {
        var passwordField = document.getElementById('password');
      
        if (this.checked) {
            passwordField.type = 'text';
          
        } else {
            passwordField.type = 'password';
          
        }
    });
</script>
</body>
</html>