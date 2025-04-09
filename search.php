
<?php
// Connect to the database
require("./db.php");

// Get the search term from POST
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Base SQL query for the Product table in Shoe Ordering database
$query = "SELECT * FROM Product";

// Add search condition if there's a search term
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $query .= " WHERE Name LIKE '%$searchTerm%'";
}

// Include existing brand and category filters from URL
$brand = isset($_GET["filter"]) ? $_GET["filter"] : null;
$category = isset($_GET["category"]) ? $_GET["category"] : null;

$whereClauses = array();

if ($brand && $brand !== "All") {
    $whereClauses[] = "Brand = '" . mysqli_real_escape_string($conn, $brand) . "'";
}

if ($category) {
    $whereClauses[] = "Category = '" . mysqli_real_escape_string($conn, $category) . "'";
}

// Combine WHERE clauses if they exist
if (!empty($whereClauses)) {
    $query .= (strpos($query, 'WHERE') === false ? " WHERE " : " AND ") . implode(" AND ", $whereClauses);
}

// Execute the query
$output = '';

if ($exec = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($exec) > 0) {
        while ($rows = mysqli_fetch_assoc($exec)) {
            $Name = $rows["Name"];
            $Image = $rows["ImageURL"];
            $output .= "<div class='product-card'>
                <img src='" . $Image . "' alt='Product'>
                <div class='product-title'>" . $Name . "</div>
            </div>";
        }
    } else {
        $output = "<p>No products found matching your search.</p>";
    }
} else {
    $output = "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
echo $output;
?>
