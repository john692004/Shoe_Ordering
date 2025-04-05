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
            width: 100vw;
            height: 100vh;
        }

        header {
            width: 98%;
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

        ::-webkit-scrollbar{
            display: none;
        }

        .dropdown-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer; 
        }

        .dropdown-btn > img {
            transform: translateY(4px);  
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
<?php
    session_start();

    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == "Customer"){
            echo "<header>
                <div class='left-selection'>
                <div class='brand'>Collections</div>
                <nav class='nav'>
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Select Brand <image src= 'down-chevron (2).png'></button>
                        
                        <div class='dropdown-content'>
                            <a href='#'>All</a>
                            <a href='#'>Adidas</a>
                            <a href='#'>Nike</a>
                            <a href='#'>Fila</a>
                            <a href='#'>Jordan</a>
                            <a href='#'>New Balance</a>
                            <a href='#'>World Balance</a>
                        </div>
                    </div>
            
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Sneakers</button>
                        <div class='dropdown-content'>
                        </div>
                    </div>
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Boots</button>
                    </div>
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Sandals </button>
                    
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div class='right-selection'>
                <div class='account-info' id='account-info'>Sign In/Register</div>
            </div>
            <input class='searchbar'  placeholder='Search' type='text'>
            <image src='magnifying-glass.png' style='transform:translateX(-150px);' width='12px' height='12px'>
            <div class='cart-icon disabled' id='cart-icon'>🛒</div>
            </header>
            <div class='dd'></div>
                <h1 class='explore-title'>Explore Our Collections</h1>

            <section class='products'>";

            require("./db.php");

            $query="select * from Product";
            

            if($exec = mysqli_query($conn,$query)){
                while($rows = mysqli_fetch_assoc($exec)){

                    $Name= $rows["Name"];
                    $Image= $rows["ImageURL"];
                    echo" <div class='product-card'>
                        <img src='" . $Image . "' alt='Product'>
                        <div class='product-title'>" . $Name . "</div>
                        </div>";
                }
            }

            echo "</section>";
        }else{
            /* ADMIN PANEL */
            
        }
    }else{
        //echo "login pre";
       // header("location: login.php");
       echo "<header>
                <div class='left-selection'>
                <div class='brand'>Collections</div>
                <nav class='nav'>
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Select Brand <image src= 'down-chevron (2).png'></button>
                        
                        <div class='dropdown-content'>
                            <a href='./explorer.php?filter=All'>All</a>
                            <a href='./explorer.php?filter=Adidas'>Adidas</a>
                            <a href='./explorer.php?filter=Nike'>Nike</a>
                            <a href='./explorer.php?filter=Fila'>Fila</a>
                            <a href='./explorer.php?filter=Jordan'>Jordan</a>
                            <a href='./explorer.php?filter=New Balance'>New Balance</a>
                            <a href='./explorer.php?filter=World Balance'>World Balance</a>
                        </div>
                    </div>
            
                    <div class='dropdown'>
                        <button class='dropdown-btn'><a href='./explorer.php?filter='>Sneakers</a></button>
                        <div class='dropdown-content'>
                        </div>
                    </div>
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Boots</button>
                    </div>
                    <div class='dropdown'>
                        <button class='dropdown-btn'>Sandals </button>
                    
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div class='right-selection'>
                <div class='account-info' id='account-info'>Sign In/Register</div>
            </div>
            <input class='searchbar'  placeholder='Search' type='text'>
            <image src='magnifying-glass.png' style='transform:translateX(-150px);' width='12px' height='12px'>
            <div class='cart-icon disabled' id='cart-icon'>🛒</div>
            </header>
            <div class='dd'></div>
                <h1 class='explore-title'>Explore Our Collections</h1>

            <section class='products'>";

            require("./db.php");

            $query = "";
            
            if(isset($_GET["filter"])){
                if($_GET["filter"] == "All"){
                    $query = "select * from Product";
                }else{
                    $query = "select * from Product WHERE Brand = '" . $_GET["filter"] . "'";
                }
            }else{
                $query = "select * from Product";
            }

            if(isset($_GET["filter"])){
                if($_GET["filter"] == "Sneakers"){
                    $query = "select * from Product where Category='" .$_GET["filter"] . "'";
                }else if($_GET["filter"]=="Boots"){
                    $query = "select * from Product WHERE Category ='" . $_GET["filter"] . "'";
                }else if($_GET["filter"]=="Sandals"){
                $query = "select * from Product where Category='" .$_GET["filter"] . "'";
            }
        }

            if($exec = mysqli_query($conn,$query)){
                while($rows = mysqli_fetch_assoc($exec)){

                    $Name= $rows["Name"];
                    $Image= $rows["ImageURL"];
                    echo" <div class='product-card'>
                        <img src='" . $Image . "' alt='Product'>
                        <div class='product-title'>" . $Name . "</div>
                        </div>";
                }
            }

            echo "</section>";
    }
?>
    <script>
        const isLoggedIn = true;
        const username = "";

        const accountInfo = document.getElementById("account-info");
        const cartIcon = document.getElementById("cart-icon");

        if (isLoggedIn) {
            accountInfo.textContent = username;
            cartIcon.classList.remove("disabled"); 
        }
    </script>

</body>
</html>