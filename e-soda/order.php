<?php
include 'config.php';

// Hanya sebagai contoh, menggunakan user_id tetap 1 untuk pesanan
$user_id = 1;

// Pastikan user_id 1 ada di tabel users
$result = $conn->query("SELECT id FROM users WHERE id = $user_id");
if ($result->num_rows == 0) {
    $conn->query("INSERT INTO users (username, password) VALUES ('sodashopper', 'hashed_password')");
}

// Pastikan product_id ada di tabel products
$product_id = $_POST['product_id'];
$result = $conn->query("SELECT id FROM products WHERE id = $product_id");
if ($result->num_rows == 0) {
    die("Produk dengan id $product_id tidak ditemukan.");
}

// Proses order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = 1; // Kuantitas sementara
    $price = $_POST['price'];
    $total_price = $price * $quantity;

    $sql = "INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES ($user_id, $product_id, $quantity, $total_price)";
    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil dibuat";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
