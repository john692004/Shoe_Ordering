<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Admin Dashboard</title> 
        <style> 
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: 'Roboto', sans-serif; 
            
        } 
        body { 
            display: flex; 

        } 
        .sidebar { 
            width: 250px; 
            background: #2C3E50; 
            color: #FFFFFF; 
            height: 100vh; 
            position: fixed; 
            padding: 20px; 
        
        } 
        .sidebar h2 { 
            font-size: 18px; 
            margin-bottom: 20px;

         } 
         .sidebar ul { list-style: none;

          } 
          .sidebar ul li { padding: 10px; margin: 5px 0; cursor: pointer; } .sidebar ul li:hover { background: #34495E; } .sidebar ul li.active { background: #3498DB; } .main-content { margin-left: 250px; padding: 20px; width: calc(100% - 250px); background: #F5F5F5; } .header { background: #FFFFFF; padding: 15px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); } .cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 20px 0; } .card { background: #FFFFFF; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; } </style> </head> <body> <div class="sidebar"> <h2>Sidebar (Left Navigation)</h2> <ul> <li class="active">[Dashboard Home]</li> <li>[Orders]</li> <li>[Products]</li> <li>[Stock]</li> <li>[Customers]</li> <li>[Sales Summary]</li> </ul> </div> <div class="main-content"> <div class="header"> <h1>Dashboard Home</h1> <div class="user-profile"> <span>Admin User</span> <button>Logout</button> </div> </div> <div class="cards"> <div class="card"> <h3>Total Orders</h3> <p>1,245</p> </div> <div class="card"> <h3>Total Products</h3> <p>320</p> </div> <div class="card"> <h3>Stock Levels</h3> <p>150 Low Stock</p> </div> <div class="card"> <h3>Total Customers</h3> <p>2,500</p> </div> </div> <!-- Add chart and table here --> </div> </body> </html>