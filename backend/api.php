
<?php
header('Content-Type: application/json');

// Connect to the database (replace with your actual database details)
$servername = "localhost";
$username = "root";
$password = "Isha";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the database for articles
$sql = "SELECT * FROM articles ORDER BY publish_date DESC";
$result = $conn->query($sql);

$articles = [];

if ($result->num_rows > 0) {
    // Fetch each article and add it to the array
    while ($row = $result->fetch_assoc()) {
        $articles[] = [
            'title' => $row['title'],
            'author' => $row['author'],
            'publish_date' => $row['publish_date'],
            'content' => $row['content']
        ];
    }
} else {
    echo "0 results";
}

$conn->close();

// Return the data as JSON
echo json_encode(['status' => 'success', 'data' => $articles]);
?>
