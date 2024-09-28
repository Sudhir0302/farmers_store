<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->title) && isset($data->price) && isset($data->image)) {
    $title = $conn->real_escape_string($data->title);
    $price = $conn->real_escape_string($data->price);
    // Extract filename from image URL
    $image = basename($conn->real_escape_string($data->image));

    $sql = "INSERT INTO cart (title, price, image) VALUES ('$title', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid input"]);
}

$conn->close();
?>
