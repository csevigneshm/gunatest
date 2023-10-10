<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve user data from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Insert user data into the database
    $sql = "INSERT INTO userdetails (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Signup was successful
        $response = array('success' => true);
    } else {
        // Signup failed
        $response = array('success' => false);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f4f4f4;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        #message {
            margin-top: 10px;
            color: green;
            font-weight: bold;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Signup</h1>
        <form id="signup-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Signup</button>
            </div>
        </form>
        <div id="message"></div>
         <div class="form-group">
            <a href="gunalogin.php" class="login-button">Login</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('signup-form');
            const message = document.getElementById('message');

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(form);

                // Perform client-side validation here if needed

                // Send data to the server using AJAX
                fetch('gunasignup.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        message.style.color = 'green';
                        message.textContent = 'Signup successful!';
                        form.reset();
                    } else {
                        message.style.color = 'red';
                        message.textContent = 'Signup failed. Please try again.';
                    }
                    message.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    message.style.color = 'red';
                    message.textContent = 'An error occurred. Please try again later.';
                    message.style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>
