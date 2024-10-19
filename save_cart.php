<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "ecom_user_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO cart (product_name, specification, price) VALUES (?, ?, ?)");

$product_names = $_POST['product_name'];
$specifications = $_POST['specification'];
$prices = $_POST['price'];

for ($i = 0; $i < count($product_names); $i++) {
    $stmt->bind_param("ssd", $product_names[$i], $specifications[$i], $prices[$i]);
    $stmt->execute();
}

$stmt->close();
$conn->close();

header("Location: cart.html");
exit();
?>
