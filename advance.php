<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Premium Account Panel - Shoe Ordering System</title>
  <!-- Google Fonts Link for Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- Font Awesome CDN for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    /* Account Navigator Container */
    .account-navigator {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      overflow: hidden;
      position: relative;
    }

    /* Background Animation */
    .account-navigator::before {
      content: '';
      position: absolute;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 10%, transparent 50%);
      animation: bgGlow 15s ease infinite;
      top: -50%;
      left: -50%;
    }

    @keyframes bgGlow {
      0% { transform: translate(0, 0); }
      50% { transform: translate(25%, 25%); }
      100% { transform: translate(0, 0); }
    }

    /* Panel Container (Glassmorphism) */
    .panel-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
      border: 1px solid rgba(255, 255, 255, 0.18);
      width: 450px;
      padding: 30px;
      position: relative;
      z-index: 1;
      overflow: hidden;
    }

    /* Tab Header (Neumorphic Tabs) */
    .tab-header {
      display: flex;
      gap: 5px;
      margin-bottom: 25px;
    }

    .tab-btn {
      flex: 1;
      padding: 15px;
      background: rgba(255, 255, 255, 0.05);
      border: none;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      border-radius: 10px;
      transition: all 0.3s ease;
      box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.2), inset -4px -4px 8px rgba(255, 255, 255, 0.1);
    }

    .tab-btn:hover {
      background: rgba(255, 255, 255, 0.15);
    }

    .tab-btn.active {
      background: linear-gradient(135deg, #ff6b6b, #ff8e53);
      color: #fff;
      box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3), -4px -4px 8px rgba(255, 255, 255, 0.1);
      font-weight: 600;
    }

    /* Tab Content */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .tab-content h2 {
      font-size: 28px;
      color: #fff;
      margin-bottom: 25px;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Form Styling */
    .login-form, .register-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .input-group {
      position: relative;
    }

    .input-group label {
      font-size: 14px;
      color:a #ddd;
      margin-bottom: 8px;
      display: block;
      font-weight: 500;
    }

    .input-group input, .input-group textarea {
      width: 100%;
      padding: 14px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      font-size: 15px;
      color: #fff;
      transition: all 0.3s ease;
      box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .input-group input:focus, .input-group textarea:focus {
      border-color: #ff6b6b;
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 10px rgba(255, 107, 107, 0.5);
      outline: none;
    }

    .input-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    /* Password Toggle Icon */
    .input-group .toggle-password {
      position: absolute;
      right: 15px;
      top: 65%; /* Adjusted for better vertical alignment */
      transform: translateY(-50%);
      color: #ddd;
      cursor: pointer;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .input-group .toggle-password:hover {
      color: #ff6b6b;
    }

    /* Adjust padding for password input to avoid overlap with icon */
    .input-group input[type="password"],
    .input-group input[type="text"].password-field {
      padding-right: 40px;
    }

    /* Submit Button */
    .submit-btn {
      padding: 14px;
      background: linear-gradient(135deg, #ff6b6b, #ff8e53);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    .submit-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(255, 107, 107, 0.6);
      background: linear-gradient(135deg, #ff8e53, #ff6b6b);
    }

    /* Responsive Design */
    @media (max-width: 480px) {
      .panel-container {
        width: 90%;
        padding: 20px;
      }
      .tab-btn {
        font-size: 14px;
        padding: 12px;
      }
      .tab-content h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="account-navigator">
    <div class="panel-container">
      <!-- Tab Navigation -->
      <div class="tab-header">
        <button class="tab-btn active" data-tab="user">User Login</button>
        <button class="tab-btn" data-tab="admin">Admin Login</button>
        <button class="tab-btn" data-tab="register">Register</button>
      </div>

      <!-- User Login Panel -->
      <div class="tab-content active" id="user">
        <h2>User Login</h2>
        <form class="login-form" onsubmit="return validateLoginForm('user');">
          <div class="input-group">
            <label for="user-email">Email</label>
            <input type="email" id="user-email" placeholder="Enter your email" required>
          </div>
          <div class="input-group">
            <label for="user-password">Password</label>
            <input type="password" id="user-password" class="password-field" placeholder="Enter your password" required>
            <i class="fas fa-eye toggle-password" data-target="user-password"></i>
          </div>
          <button type="submit" class="submit-btn">Login</button>
        </form>
      </div>

      <!-- Admin Login Panel -->
      <div class="tab-content" id="admin">
        <h2>Admin Login</h2>
        <form class="login-form" onsubmit="return validateLoginForm('admin');">
          <div class="input-group">
            <label for="admin-email">Email</label>
            <input type="email" id="admin-email" placeholder="Enter admin email" required>
          </div>
          <div class="input-group">
            <label for="admin-password">Password</label>
            <input type="password" id="admin-password" class="password-field" placeholder="Enter admin password" required>
            <i class="fas fa-eye toggle-password" data-target="admin-password"></i>
          </div>
          <button type="submit" class="submit-btn">Login</button>
        </form>
      </div>

      <!-- Register Panel -->
      <div class="tab-content" id="register">
        <h2>Register</h2>
        <form class="register-form" onsubmit="return validateRegisterForm();">
          <div class="input-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" placeholder="Enter your full name" required>
          </div>
          <div class="input-group">
            <label for="reg-email">Email</label>
            <input type="email" id="reg-email" placeholder="Enter your email" required>
          </div>
          <div class="input-group">
            <label for="phone">Phone No.</label>
            <input type="tel" id="phone" placeholder="Enter your phone number" required>
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
        </form>
      </div>
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

    // Validation Functions
    function validateLoginForm(prefix) {
      const email = document.getElementById(`${prefix}-email`).value;
      const password = document.getElementById(`${prefix}-password`).value;

      // Email must contain @gmail.com
      if (!email.endsWith('@gmail.com')) {
        alert('Email must be a Gmail address (e.g., example@gmail.com)');
        return false;
      }

      // Password validation
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long and contain an uppercase letter, lowercase letter, number, and special character.');
        return false;
      }

      alert(`${prefix.charAt(0).toUpperCase() + prefix.slice(1)} Login Submitted`);
      return true;
    }

    function validateRegisterForm() {
      const email = document.getElementById('reg-email').value;
      const phone = document.getElementById('phone').value;
      const password = document.getElementById('reg-password').value;

      // Email must contain @gmail.com
      if (!email.endsWith('@gmail.com')) {
        alert('Email must be a Gmail address (e.g., example@gmail.com)');
        return false;
      }

      // Phone must be 11 digits
      const phoneRegex = /^\d{11}$/;
      if (!phoneRegex.test(phone)) {
        alert('Phone number must be exactly 11 digits.');
        return false;
      }

      // Password validation
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long and contain an uppercase letter, lowercase letter, number, and special character.');
        return false;
      }

      alert('Registration Submitted');
      return true;
    }
  </script>
</body>
</html>