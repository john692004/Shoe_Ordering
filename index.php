<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Ordering System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url("images (3).jpg");
            overflow-x: hidden;
        }

        /* Loading Screen Styles */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.8s ease;
        }

        .loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Particle Background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/black-linen.png');
            opacity: 0.1;
            animation: particleMove 20s infinite linear;
        }

        @keyframes particleMove {
            0% { background-position: 0 0; }
            100% { background-position: 1000px 1000px; }
        }

        /* Logo Animation */
        .loading-logo {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 2rem;
            animation: glow 2s infinite ease-in-out;
        }

        @keyframes glow {
            0%, 100% { text-shadow: 0 0 10px #ff6f61, 0 0 20px #ff6f61, 0 0 30px #ff6f61; }
            50% { text-shadow: 0 0 20px #ff8a75, 0 0 30px #ff8a75, 0 0 40px #ff8a75; }
        }

        /* Progress Bar */
        .progress-container {
            width: 300px;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .progress-bar {
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, #ff6f61, #ff8a75);
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .loading-text {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        /* Navigation Bar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(26, 26, 26, 0.5);
            backdrop-filter: blur(10px);
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease;
        }

        .navbar .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .navbar ul li {
            position: relative;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #ff6f61;
            transform: translateY(-2px);
        }

        .navbar ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #ff6f61;
            bottom: -5px;
            left: 0;
            transition: width 0.3s ease;
        }

        .navbar ul li a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1600585154347-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            background-attachment: fixed; /* Parallax effect */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            position: relative;
            padding: 0 5%;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            animation: fadeInDown 1s ease;
        }

        .hero-content p {
            font-size: 1.4rem;
            font-weight: 300;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease 0.3s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .cta-button {
            background: linear-gradient(45deg, #ff6f61, #ff8a75);
            color: #fff;
            padding: 1rem 3rem;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1s ease 0.6s;
            opacity: 0;
            animation-fill-mode: forwards;
            box-shadow: 0 0 10px rgba(255, 111, 97, 0.5);
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(255, 111, 97, 0.8), 0 0 30px rgba(255, 111, 97, 0.5);
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            padding: 3rem 5%;
            text-align: center;
            color: #fff;
        }

        .footer p {
            font-size: 1rem;
            font-weight: 300;
            margin-bottom: 1rem;
        }

        .footer .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .footer .social-links a {
            color: #fff;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .footer .social-links a:hover {
            color: #ff6f61;
        }

        /* Animations */
        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 3%;
            }

            .navbar .logo {
                font-size: 1.5rem;
            }

            .navbar ul {
                gap: 1rem;
            }

            .navbar ul li a {
                font-size: 1rem;
            }

            .hero-content h1 {
                font-size: 3rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .cta-button {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }

            .loading-logo {
                font-size: 2rem;
            }

            .progress-container {
                width: 200px;
            }
        }

        /* Main Content (Hidden Initially) */
        .main-content {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="particles"></div>
        <div class="loading-logo">Shoe Ordering</div>
        <div class="loading-text">Preparing Your Shopping Experience...</div>
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="logo">Shoe Ordering</div>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="login.php">Account</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="explorer.php">Explore</a></li>
            </ul>
        </nav>

        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-content">
                <h1>Step Into Style</h1>
                <p>Discover the perfect pair of shoes with our premium collection. Order now and elevate your wardrobe!</p>
              
                <a href="#explore" class="cta-button">Explore Now</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2025 Shoe Ordering System. All Rights Reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </footer>
    </div>

    <!-- Font Awesome for Social Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- JavaScript for Loading Animation and Navbar Scroll Effect -->
    <script>
        const loadingScreen = document.getElementById('loadingScreen');
        const mainContent = document.getElementById('mainContent');
        const progressBar = document.getElementById('progressBar');

        let percentage = 0;

        // Simulate loading progress
        const loadingInterval = setInterval(() => {
            percentage += 1;
            progressBar.style.width = `${percentage}%`;

            if (percentage >= 100) {
                clearInterval(loadingInterval);
                // Fade out loading screen
                loadingScreen.classList.add('hidden');
                // Show main content
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                    mainContent.style.display = 'block';
                }, 800);
            }
        }, 30); // Adjust speed of loading (30ms per increment)

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(26, 26, 26, 0.9)';
                navbar.style.backdropFilter = 'blur(15px)';
            } else {
                navbar.style.background = 'rgba(26, 26, 26, 0.5)';
                navbar.style.backdropFilter = 'blur(10px)';
            }
        });
    </script>
</head>
</html>