<?php
session_start();
include('db.php');

if (isset($_POST["login"])){
    $email = filter_input(INPUT_POST, "user-email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "user-password", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "admin-email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "admin-password", FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "SELECT * FROM User WHERE Email = '$email'";
    $execQuery = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($execQuery) != 0){
        if($rows = mysqli_fetch_assoc($execQuery)){
            $role = $rows["Role"];
            $_SESSION["role"] = $role;
            header("location: explorer.php");
        }
    }else{
        header("location: login.php?error");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Premium Account Panel - Shoe Ordering System</title>
  <!-- Google Fonts Link for Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome CDN for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    body {
 background-image: url("download.jpeg");
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
    }

    .panel-container {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(20px);
      border-radius: 25px;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.25);
      width: 500px;
      padding: 40px;
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .panel-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
    }
    webkit

    /* Header Styling */
    .panel-header {
      text-align: center;
      margin-bottom: 35px;
    }

    .panel-header h1 {
      text-align: center;
      color: #fff;
      font-size: 40px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
    }

    .panel-header p {
      color: #ddd;
      font-size: 15px;
      margin-top: 8px;
      font-weight: 400;
    }

    /* Tab Header */
    .tab-header {
      display: flex;
      gap: 15px;
      margin-bottom: 35px;
      background: rgba(255, 255, 255, 0.05);
      padding: 5px;
      border-radius: 15px;
    }

    .tab-btn {
      flex: 1;
      padding: 15px;
      background: transparent;
      border: none;
      font-size: 16px;
      font-weight: 500;
      color: #fff;
      cursor: pointer;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .tab-btn:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .tab-btn.active {
      background: linear-gradient(135deg, #ff6b6b, #ff8e53);
      box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
      font-weight: 600;
    }

    /* Tab Content */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
      animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .tab-content h2 {
      font-size: 28px;
      color: #fff;
      margin-bottom: 30px;
      text-align: center;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1.5px;
    }

    /* Form Styling */
    .login-form, .register-form {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .input-group {
      position: relative;
    }

    .input-group label {
      font-size: 14px;
      color: #ddd;
      margin-bottom: 10px;
      display: block;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .input-group input:focus + label,
    .input-group select:focus + label,
    .input-group textarea:focus + label {
      color: #ff6b6b;
    }

    .input-group input, .input-group textarea {
      width: 100%;
      padding: 15px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 12px;
      font-size: 15px;
      color: #fff;
      transition: all 0.3s ease;
      box-shadow: inset 2px 2px 6px rgba(0, 0, 0, 0.2);
    }

    .input-group input:focus, .input-group textarea:focus {
      border-color: #ff6b6b;
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 15px rgba(255, 107, 107, 0.5);
      outline: none;
    }

    .input-group textarea {
      resize: none;
      min-height: 40px;
    }

    .input-group select {
      width: 100%;
      padding: 15px;
      background: #000000;
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 12px;
      font-size: 15px;
      color: #fff;
      transition: all 0.3s ease;
      box-shadow: inset 2px 2px 6px rgba(0, 0, 0, 0.2);
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
      background-repeat: no-repeat;
      background-position: right 15px top 50%;
      padding-right: 40px;
    }

    .input-group select:focus {
      border-color: #ff6b6b;
      background: #1a1a1a;
      box-shadow: 0 0 15px rgba(255, 107, 107, 0.5);
      outline: none;
    }

    .input-group select option {
      background: #000000;
      color: #fff;
    }

    /* Password Toggle */
    .input-group .toggle-password {
      position: absolute;
      right: 15px;
      top: 65%;
      transform: translateY(-50%);
      color: #ddd;
      cursor: pointer;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .input-group .toggle-password:hover {
      color: #ff6b6b;
    }

    .input-group input[type="password"],
    .input-group input[type="text"].password-field {
      padding-right: 45px;
    }

    input[type="number"]::-webkit-inner-spin-button{
        display: none;
    }

    /* Submit Button */
    .submit-btn {
      padding: 16px;
      background: linear-gradient(135deg, #ff6b6b, #ff8e53);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
      position: relative;
      overflow: hidden;
    }

    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(255, 107, 107, 0.6);
      background: linear-gradient(135deg, #ff8e53, #ff6b6b);
    }

    .submit-btn:active {
      transform: scale(0.98);
    }

    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Forgot Password & Extra Links */
    .extra-links {
      text-align: center;
      margin-top: 20px;
    }

    .extra-links a {
      color: #ff6b6b;
      font-size: 14px;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .extra-links a:hover {
      color: #ff8e53;
      text-decoration: underline;
    }

    /* Error Message */
    .error-message {
      color: #ff6b6b;
      font-size: 13px;
      margin-top: 5px;
      display: none;
      text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
      .panel-container {
        width: 90%;
        padding: 30px;
      }
      .tab-btn {
        font-size: 14px;
        padding: 12px;
      }
      .tab-content h2 {
        font-size: 24px;
      }
      .panel-header h1 {
        font-size: 28px;
      }
    }
  </style>
</head>
<body>
  <div class="panel-container">
    <!-- Header -->
    <div class="panel-header">
      <h1>Shoe Ordering</h1>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-header">
      <button class="tab-btn active" data-tab="login">Login</button>
      <button class="tab-btn" data-tab="register">Register</button>
    </div>

    <!-- Login Panel -->
    <div class="tab-content active" id="login">
      <h2>Login</h2>
      <form class="login-form" onsubmit="return handleLogin(event);">
        <div class="input-group">
          <label for="login-email">Email</label>
          <input type="email" id="login-email" placeholder="Enter your email" required>
        </div>
        <div class="input-group">
          <label for="login-password">Password</label>
          <input type="password" id="login-password" class="password-field" placeholder="Enter your password" required>
          <i class="fas fa-eye toggle-password" data-target="login-password"></i>
        </div>
        <div class="input-group">
          <label for="role">Role</label>
          <select id="role" required>
            <option value="" disabled selected>Select your role</option>
            <option value="user">Customer</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="submit-btn">Login</button>
        <div class="error-message" id="login-error"></div>
      </form>
      <div class="extra-links">
        <a href="#">Forgot Password?</a> | <a href="#">Need Help?</a>
      </div>
    </div>

    <!-- Register Panel -->
    <div class="tab-content" id="register">
      <h2>Register</h2>
      <form class="register-form" onsubmit="return handleRegister(event);">
        <div class="input-group">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" placeholder="Enter your full name" required>
        </div>
        <div class="input-group">
          <label for="reg-email">Email</label>
          <input type="email" id="reg-email" placeholder="Enter your email" required>
        </div>
        <div class="input-group">

        <label for="phonenumber">Phone Number</label>
        <input type="number" name="PhoneNumber" id="phonenumber" placeholder=" " style="width: 420px;">
         
          
        </div>
        <div class="input-group">
          <label for="address">Address</label>
          <textarea id="address" placeholder="Enter your address" required></textarea>
        </div>
        <div class="input-group">
          <label for="reg-password">Password</label>
          <input type="password" id="reg-password" class="password-field" placeholder="Create a password" required>
          <i class="fas fa-eye toggle-password" data-target="reg-password"></i>
        </div>
        <button type="submit" class="submit-btn">Register</button>
        <div class="error-message" id="register-error"></div>
      </form>
    </div>
  </div>

  <script>
    // Tab Switching Logic
    document.querySelectorAll('.tab-btn').forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        button.classList.add('active');
        const tabId = button.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
      });
    });

    // Password Visibility Toggle Logic
    document.querySelectorAll('.toggle-password').forEach(icon => {
      icon.addEventListener('click', () => {
        const targetId = icon.getAttribute('data-target');
        const passwordField = document.getElementById(targetId);

        if (passwordField.type === 'password') {
          passwordField.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          passwordField.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    });

    // Form Submission Handlers
    function handleLogin(event) {
      event.preventDefault();
      const email = document.getElementById('login-email').value;
      const password = document.getElementById('login-password').value;
      const role = document.getElementById('role').value;
      const errorMessage = document.getElementById('login-error');
      const submitBtn = document.querySelector('.login-form .submit-btn');

      errorMessage.style.display = 'none';
      submitBtn.disabled = true;

      // Email validation
      if (!email.endsWith('@gmail.com')) {
        showError(errorMessage, 'Please enter a valid Gmail address.');
        submitBtn.disabled = false;
        return false;
      }

      // Password validation
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password)) {
        showError(errorMessage, 'Password must be 8+ characters with uppercase, lowercase, number, and special character.');
        submitBtn.disabled = false;
        return false;
      }

      // Role validation
      if (!role) {
        showError(errorMessage, 'Please select a role.');
        submitBtn.disabled = false;
        return false;
      }

      // Simulate async login (replace with actual backend call)
      setTimeout(() => {
        alert(`${role.charAt(0).toUpperCase() + role.slice(1)} Login Successful`);
        submitBtn.disabled = false;
      }, 1000);

      return false;
    }

    function handleRegister(event) {
      event.preventDefault();
      const fullname = document.getElementById('fullname').value;
      const email = document.getElementById('reg-email').value;
      const phone = document.getElementById('phone').value;
      const password = document.getElementById('reg-password').value;
      const errorMessage = document.getElementById('register-error');
      const submitBtn = document.querySelector('.register-form .submit-btn');

      errorMessage.style.display = 'none';
      submitBtn.disabled = true;

      // Fullname validation
      if (fullname.length < 2) {
        showError(errorMessage, 'Full name must be at least 2 characters.');
        submitBtn.disabled = false;
        return false;
      }

      // Email validation
      if (!email.endsWith('@gmail.com')) {
        showError(errorMessage, 'Please enter a valid Gmail address.');
        submitBtn.disabled = false;
        return false;
      }

      // Phone validation
      const phoneRegex = /^\d{11}$/;
      if (!phoneRegex.test(phone)) {
        showError(errorMessage, 'Phone number must be exactly 11 digits.');
        submitBtn.disabled = false;
        return false;
      }

      // Password validation
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password)) {
        showError(errorMessage, 'Password must be 8+ characters with uppercase, lowercase, number, and special character.');
        submitBtn.disabled = false;
        return false;
      }

      // Simulate async registration (replace with actual backend call)
      setTimeout(() => {
        alert('Registration Successful');
        submitBtn.disabled = false;
      }, 1000);

      return false;
    }

    function showError(element, message) {
      element.textContent = message;
      element.style.display = 'block';
    }
  </script>
</body>
</html>