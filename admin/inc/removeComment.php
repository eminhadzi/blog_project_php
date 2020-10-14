<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    require_once("../../config.php");
    global $pdo;
    $query = "DELETE FROM comments WHERE comment_id = {$id}";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    header("Location: ../comments.php#comments_anchor");
}
