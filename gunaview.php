<?php
// Database configuration
 $host = "localhost"; // Change to your MySQL server host
$username = "id21336984_guna"; // Change to your MySQL username
$password = "Guna@1232"; // Change to your MySQL password
$dbname = "id21336984_test"; // Change to your database name

// Establish a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all user details
$sql = "SELECT * FROM userdetails";
$result = $conn->query($sql);

// Check if there are any user details to display
if ($result->num_rows > 0) {
    echo "<h1>User Details</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Password</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No user details found.";
}

// Close the database connection
$conn->close();
?>
