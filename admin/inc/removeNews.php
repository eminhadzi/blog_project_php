<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    require_once("../../config.php");
    global $pdo;
    $query = "DELETE FROM news WHERE news_id = {$id}";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $filename = '../../images/news' . $id . '.jpg';
    unlink($filename);
    header("Location: ../posts.php#news_list");
}
