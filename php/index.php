// add-to-cart.php
session_start();
include 'db_connection.php';

$userId = $_SESSION['user_id'];
$productId = $_GET['product_id'];

$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, 1)";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}
$conn->close();
