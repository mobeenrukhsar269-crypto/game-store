<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_id = (int)$_POST['game_id'];
    $title = htmlspecialchars($_POST['title']);
    $price = (float)$_POST['price'];
    $image = htmlspecialchars($_POST['image']);
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if game already exists in cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['game_id'] === $game_id) {
            $item['quantity'] += $quantity;
            $itemExists = true;
            break;
        }
    }

    if (!$itemExists) {
        $_SESSION['cart'][] = [
            'game_id' => $game_id,
            'title' => $title,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }

    echo "Added to cart";
} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>