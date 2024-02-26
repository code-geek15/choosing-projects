<?php
// Database configuration
$host = "localhost"; // Change this if your database is hosted on a different server
$dbname = "geekschat";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Initialize an index variable


    // Check if a search query is provided
    if (isset($_POST['search_username'])) {
        $search_username = trim($_POST['search_username']); // Remove leading/trailing whitespace
        
        // SQL query to search for a specific username
        $sql = "SELECT username, email FROM users WHERE username = :search_username"; // Changed '==' to '='
        
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        
        // Bind the search parameter
        $stmt->bindParam(':search_username', $search_username, PDO::PARAM_STR);
        
        // Execute the SQL statement
        $stmt->execute();
        
        // Fetch all rows as an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Check if any results were found
      if (count($results) > 0) {
    $index = 0; // Initialize an index variable
    foreach ($results as $row) {
        echo "<div class='result' onclick='generateMessageArea(this, $index, \"" . $row['username'] . "\", \"" . $row['email'] . "\")'>";
        echo "<div class='result-item'>";
        echo "  <img src='src=assets/images/-1.jpg'>".' ' . $row['username'] . "<br>";
        echo "</div>";
        echo "</div>";

        $index++; // Increment the index for each result
    
}

        } else {
            echo "No results found for username: " . $search_username;
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
