if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Customer"){
            echo "<span class='navIndicator'></span>";
            echo "<nav>
                    <span>
                        <h3>Quick Ride</h3>
                        <button onclick='setActiveBtn(1)' id='homeBtn' class='active'>Home</button>
                        <button onclick='setActiveBtn(2)' id='bookingBtn'>My Bookings</button>
                        <button onclick='setActiveBtn(3)' id='aboutBtn'>About</button>
                        <button onclick='setActiveBtn(4)' id='contactBtn'>Contact</button>
                    </span>
                    <span class='logout'>
                        <a href='../auth/logout.php'>logout</a>
                    </span>
                </nav>";
            echo "<div class='homePage active'>";
            include_once("./panels/customer/customer.php");
            include_once("./components/carSelection.php");
            echo "<span class='carsDisplay'>";
            include_once("./components/cars.php");
            echo "</span>
                </section>";
            echo "</div>";

            include_once("./panels/customer/aboutUs.php");
            include_once("./panels/customer/contactUs.php");
        }
    }else{
        echo "<span class='navIndicator'></span>";
        echo "<nav>
                <span>
                    <h3>Quick Ride</h3>
                    <button onclick='setActiveBtn(1)' id='homeBtn' class='active'>Home</button>
                    <button onclick='setActiveBtn(2)' id='aboutBtn'>About</button>
                    <button onclick='setActiveBtn(3)' id='contactBtn'>Contact</button>
                </span>
                <span class='authGuest'>
                    <a href='../auth/login.php'>Log In</a>
                    <a href='../auth/signup.php'>Sign Up</a>
                </span>
            </nav>";
        echo "<div class='homePage active'>
                <div class='guestBG'>
                    <span>
                        <p>Fast & Affordable</p>
                    </span>
                </div>";
        include_once("./components/carSelection.php");
        echo "<span class='carsDisplay'>";
        include_once("./components/cars.php");
        echo " </span>
            </section>
            </div>";

        include_once("./panels/customer/aboutUs.php");
        include_once("./panels/customer/contactUs.php");
    }

    if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Admin"){
            include_once("./panels/admin/admin.php");
        }
    }