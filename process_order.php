<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data (sanitize input)
$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Insert into orders table using prepared statement
$sql = "INSERT INTO orders (name, phone, address, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $phone, $address, $email);

$result = $stmt->execute();

if ($result) {
    $message = "Order placed successfully!";
} else {
    $message = "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: url('bg.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .message {
            font-size: 1.5em;
            margin-top: 20px;
        }
        .success {
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
        .home-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 20px;
            text-decoration: none;
        }
        .home-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Status</h1>
        <div class="message <?= $result ? 'success' : 'error' ?>">
            <?= $message ?>
        </div>
        <a href="home.html" class="home-btn">Return to Home</a>
    </div>
</body>
</html>
