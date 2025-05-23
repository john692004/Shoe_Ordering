<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Shoe Ordering System</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 40px;
            background: linear-gradient(135deg, #ff6f61, #6b48ff); /* Full-page gradient */
            background-attachment: fixed; /* Keeps gradient stable on scroll */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .about-panel {
            max-width: 700px;
            background: rgba(255, 255, 255, 0.95); /* Slightly transparent white for contrast */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow for depth */
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .about-panel:hover {
            transform: translateY(-5px);
        }
        .about-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #ff6f61, #6b48ff);
        }
        h1 {
          
            font-size: 2.5em;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        p {
            font-size: 1.1em;
            color: #7f8c8d;
            line-height: 1.8;
            margin: 5px 0;
        }
        .highlight {
            color: #ff6f61;
            font-weight: 600;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: linear-gradient(to right, #ff6f61, #6b48ff);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .button:hover {
            background: linear-gradient(to right, #6b48ff, #ff6f61);
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .about-panel {
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
            p {
              
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="about-panel">
        <h1> Shoe Ordering System</h1>
        <p>Welcome to our <span class="highlight">Shoe Ordering System</span>! We’re passionate about helping you find the perfect pair of shoes with unmatched ease and style. From sleek sneakers to elegant boots, our platform is designed to deliver a premium ordering experience.</p>
        <p>Launched in <span class="highlight">2025</span>, we blend cutting-edge technology with a love for footwear to bring you top-quality options. Explore our curated collection, personalize your order, and step confidently into every moment.</p>
        <a href="discovermore.php" class="button">Discover More</a>
    </div>
</body>
</html>