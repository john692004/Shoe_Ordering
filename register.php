<?php
session_start();
include('db.php');

if (isset($_POST["register"])) {
    $fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $phoneNo = filter_input(INPUT_POST, "phoneNo", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);
   
    if($password !== $confirm_password) {
        $registration_error = "Passwords do not match.";
    }else{
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
        $query = "SELECT * FROM User WHERE PhoneNumber = '$phoneNo' OR Email = '$email'";
        $execQuery = mysqli_query($conn, $query);

        if(mysqli_num_rows($execQuery) != 0) {
            $registration_error = "Phone Number or Email already exists.";
        }else{
            $query = "INSERT INTO User VALUES (null, '$fullname', '$email', '$password', '$phoneNo', '$address', 'Customer')";
            $execQuery = mysqli_query($conn, $query);

            if($execQuery){
                header("Location: login.php?registered");
            }else{
                $registration_error = "Error in registration. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>

        body {
            background-image: url(" images (13).jpeg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: white;
        }

        input[type="number"]::-webkit-inner-spin-button {
            display: none;
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
            width: 94%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        ::-webkit-scrollbar {
            display: none;
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
            margin-top: 5px;
            text-wrap: nowrap;
        }
        .show-password > label {
            margin-left: 5px;
        }

        .show-password input {
            margin-right: 0px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Register</h2>

    
        <?php if (!empty($registration_error)): ?>
            <div class="error-message"><?php echo $registration_error; ?></div>
        <?php endif; ?>

        
        <form method="POST">
            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" id="fullname" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="phone">Phone Number:</label>
            <input type="number" name="phoneNo" id="phone" required><br><br>

            <label for="address">Address:</label>
            <input type="address" name="address" id="address" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br><br>
            
            <div class="show-password">
                <input type="checkbox" id="showPassword"> <label for="showPassword">Show Password</label>
            </div><br>

            

            <button type="submit" name="register">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
    
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('confirm_password');
            
            if (this.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
            }
        });
    </script>

</body>
</html>
