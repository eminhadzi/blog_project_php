<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    require_once("../../config.php");
    global $pdo;
    $query = "DELETE FROM users WHERE user_id = {$id}";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    header("Location: ../users.php#header_title");
}
