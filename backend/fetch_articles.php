<?php
header('Content-Type: application/json');

// Get the category from the query parameters
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Connect to your MySQL database
$host = 'localhost';
$username = 'root';
$password = 'Isha';
$dbname = 'my_database';

$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch articles for the specific category
$sql = "SELECT * FROM articles WHERE category = ? ORDER BY publish_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);  // "s" means string type for category
$stmt->execute();
$result = $stmt->get_result();

// Prepare the response
$articles = [];
while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}

$stmt->close();
$conn->close();

// Return the articles as JSON
echo json_encode([
    'status' => 'success',
    'articles' => $articles
]);

?>
