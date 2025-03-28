<?php
$conn="";
try{
    $conn=mysqli_connect("localhost","root","","Shoe");
}catch(mysqli_sql_exception){
    echo"";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">

        *{
         margin: 0;
         padding: 0;
        }

        body {
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid blue;
            border-radius: 20px;
            padding: 50px;
            gap: 10px;
        }

        p {
           align-self: start; 
        }
     button{
        font-weight: 700;
        padding-block: 5px;
        padding-inline: 20px;
     }

     a, a:visited{
         text-decoration:underline;
         color:black;
     }
     span{
        display: flex;
        flex-direction: row;
        font-size: 12px;
         }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="./dashboard.php">
    <h2>Login</h2>

    <p>Username</p>
    <input type="text"required>

    <p>Password</p>
    <input type="password"required>

    <button>Login</button>

    <span>
    <p>No account yet?&nbsp;</p>
    <a href="./signup.php">Sign Up</a>
    </span>

</form>
</body>
</html>