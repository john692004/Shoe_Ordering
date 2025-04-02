<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            background-color: #e6e6e6;
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: #000000;
            position: fixed;
            top: 0px;
        }

        .left-selection{
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
            font-family:Helvetica;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;   
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: #22252b;
            min-width: 160px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background: #30343c;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        .right-selection{
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .account-info{
            font-size: 16px;
            cursor: pointer;
        }
        .cart-icon{
            font-size: 18px;
            cursor: pointer;
        }
        .disabled{
            color: gray;
            cursor: not-allowed;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            max-height: calc(100vh - 80px);
        }

        .product-card {
            background: #fffff6;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            
        }

        .product-title {
            margin: 5px 0;
        }
        .explore-title{
            font-size: 48px;
            text-align: center;
            margin-top: 40px;
            color: white;
            background-color: #000000; 
        }
        .dd {
            height: 15px;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <div class="left-selection">
        <div class="brand">Collections</div>
        <nav class="nav">
            <div class="dropdown">
                <button class="dropdown-btn">Select Brand ⌄</button>
                <div class="dropdown-content">
                    <a href="#">All</a>
                    <a href="#">Adidas</a>
                    <a href="#">Nike</a>
                    <a href="#">Fila</a>
                    <a href="#">Jordan</a>
                    <a href="#">New Balance</a>
                    <a href="#">World Balance</a>
                </div>
            </div>
       
            <div class="dropdown">
                <button class="dropdown-btn">Sneakers</button>
                <div class="dropdown-content">
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Boots</button>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">Sandals </button>
              
                    
                </div>
            </div>
        </nav>
    </div>
    <div class="right-selection">
        <div class="account-info" id="account-info">Sign In/Register</div>
        <div class="cart-icon disabled" id="cart-icon">🛒</div>
    </div>
</header>
<div class="dd"></div>
    <h1 class="explore-title">Explore Our Collections</h1>


    <section class="products">
        <div class="product-card">
            <img src="Screenshot 2025-03-29 123931.png" alt="Product">
            <div class="product-title">New Balance Men's 608 V5 Walking Shoe</div>
        </div>
        <div class="product-card">
            <img src="Screenshot 2025-03-29 124856.png" alt="Product">
            <div class="product-title">New Balance Men's Fresh Foam 520 v9 Wide Running Shoe</div>
        </div>
        <div class="product-card">
            <img src="Screenshot 2025-03-29 125154.png" alt="Product">
            <div class="product-title">New Balance Men's 680 Running Shoe</div>
        </div>
        <div class="product-card">
            <img src="Screenshot 2025-03-29 125650.png" alt="Product">
            <div class="product-title">Adidas Women's Terrex Tracefinder Trail Running Shoe</div>
        </div>
        <div class="product-card">
            <img src="Screenshot 2025-03-29 130046.png" alt="Product">
            <div class="product-title">Adidas Women's Ultra Run 5 Running Shoe</div>
        </div>
        <div class="product-card">
            <img src="Screenshot 2025-03-29 130615.png" alt="Product">
            <div class="product-title">Nike Women's V5 RNR Sneaker</div>
        </div>

    <div class="product-card">
        <img src="Screenshot 2025-03-29 130912.png" alt="Product">
        <div class="product-title">Nike Women's Air Max Portal Sneaker</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 131127.png" alt="Product">
        <div class="product-title">Nike Men's Victori One Slide Sandal</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 131330.png" alt="Product">
        <div class="product-title">Nike Men's Offcourt Slide Sandal</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 131648.png" alt="Product">
        <div class="product-title">Adidas Adilette Comfort Slide Sandal</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 134904.png" alt="Product">
        <div class="product-title">Adidas Kids' Adilette Shower Slide Sandal Little/Big Kid</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 135317.png" alt="Product">
        <div class="product-title">Nike Kids' Kawa Slide Sandal Little/Big Kid</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 135902.png" alt="Product">
        <div class="product-title">Nike Women's Victori One Slide Sandal</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 141423.png" alt="Product">
        <div class="product-title">New Balance Kids' 750 V 2 Water Sandal Baby/Toddler</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 142003.png" alt="Product">
        <div class="product-title">New Balance Women's Arishi V4 Fresh Foam Running Shoe</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 143236.png" alt="Product">
        <div class="product-title">New Balance Men's Fresh Foam 520 v9 Wide Running Shoe</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 143605.png" alt="Product">
        <div class="product-title">New Balance Men's Fresh Foam Roav Running Shoe</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 144008.png" alt="Product">
        <div class="product-title">New Balance Men's 515 Retro Sneaker</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 144831.png" alt="Product">
        <div class="product-title">New Balance Men's 997R Retro Sneaker</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 145223.png" alt="Product">
        <div class="product-title">New Balance Men's 997H Retro Sneaker</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 152148.png" alt="Product">
        <div class="product-title">Adidas Copa Pure 3 Club Firm/Multi-Ground Boots Kids</div>
    </div>
    <div class="product-card">
        <img src="Screenshot 2025-03-29 152607.png">
        <div class="product-title">Adidas Codechaos Boot Spikeless Golf Shoes </div>
    </div>
    <div class="product-card">
        <img src="Zip-Up Long Sleeve Hoodie.jpg" alt="Product">
        <div class="product-title">Zip-Up Long Sleeve Hoodie</div>
    </div>
    <div class="product-card">
        <img src="Collar 3D Rose Mini Tube Dress.jpg" alt="Product">
        <div class="product-title">Collar 3D Rose Mini Tube Dress</div>
    </div>
    <div class="product-card">
        <img src="Collar Halter Back Metal Decorative Buckle.jpg" alt="Product">
        <div class="product-title">Collar Halter Back Metal Decorative Buckle</div>
    </div>
    <div class="product-card">
        <img src="Drawstring Halter Backless Tank Top.jpg" alt="Product">
        <div class="product-title">Drawstring Halter Backless Tank Top</div>
    </div>
    <div class="product-card">
        <img src="Drawstring Waist Wide Leg Pants.jpg" alt="Product">
        <div class="product-title">Drawstring Waist Wide Leg Pants</div>
    </div>
    <div class="product-card">
        <img src="Floral Knitted Long Dress.jpg" alt="Product">
        <div class="product-title">Floral Knitted Long Dress</div>
    </div>
    <div class="product-card">
        <img src="Floral Print Ruched Tube Top.jpg" alt="Product">
        <div class="product-title">Floral Print Ruched Tube Top</div>
    </div>
    <div class="product-card">
        <img src="Halter Plunging Neck Fitted Mermaid Dress.jpg" alt="Product">
        <div class="product-title">Halter Plunging Neck Fitted Mermaid Dress</div>
    </div>
    <div class="product-card">
        <img src="Minimalist Casual Straight Leg Pants.jpg" alt="Product">
        <div class="product-title">Minimalist Casual Straight Leg Pants</div>
    </div>
    <div class="product-card">
        <img src="Ruffle Hem Cami Top" alt="Product">
        <div class="product-title">Ruffle Hem Cami Top</div>
    </div>
    <div class="product-card">
        <img src="Sleeveless Knot Back Crisscross Tank Top.jpg" alt="Product">
        <div class="product-title">Sleeveless Knot Back Crisscross Tank Top</div>
    </div>
    <div class="product-card">
        <img src="Star Patchwork Fringe Baggy Denim Jeans Pants" alt="Product">
        <div class></div>




    </section>
    </div>
    
    <script>
        const isLoggedIn = true;
        const username = "Cristel";

        const accountInfo = document.getElementById("account-info");
        const cartIcon = document.getElementById("cart-icon");

        if (isLoggedIn) {
            accountInfo.textContent = username;
            cartIcon.classList.remove("disabled"); 
        }
    </script>

</body>
</html>