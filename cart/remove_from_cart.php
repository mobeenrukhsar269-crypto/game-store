<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = (int)$_POST['index'];

    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
        echo "Item removed";
    } else {
        http_response_code(400);
        echo "Item not found";
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}
?>