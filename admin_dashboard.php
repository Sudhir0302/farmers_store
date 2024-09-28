<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}
include('config.php'); // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
        }
        .dashboard-container {
            padding: 20px;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <h2>Orders</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
            </tr>
            <?php
            $stmt = $conn->query("SELECT * FROM orders");
            while ($order = $stmt->fetch_assoc()) {
                echo "<tr>
                        <td>{$order['id']}</td>
                        <td>{$order['name']}</td>
                        <td>{$order['phone']}</td>
                        <td>{$order['address']}</td>
                        <td>{$order['email']}</td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
