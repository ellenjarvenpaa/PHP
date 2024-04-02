<?php
global $DBH;
require_once 'dbconnect.php';

if (isset($_GET['id'])){
    $DBH->beginTransaction();
    $data = [
        'media_id' => $_GET['id']
    ];

    // delete file from server
    $sql = 'SELECT filename FROM MediaItems WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
        $row = $STH->fetch();
        $filename = $row['filename'];
        $destination = __DIR__ . '/uploads/' . $filename;
        if (!unlink($destination)){
            echo "Could not delete file from the server.";
            $DBH->rollBack();
            exit;
        }
    } catch (PDOException $e){
        echo "Could not delete file from the server.";
        file_put_contents('PDOErrors.txt', 'deletedata.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

    // delete likes
    $sql = 'DELETE FROM Likes WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    } catch (PDOException $e){
        echo "Could not delete likes from the database.";
        file_put_contents('PDOErrors.txt', 'deletedata.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

    // delete comments
    $sql = 'DELETE FROM Comments WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    } catch (PDOException $e){
        echo "Could not delete comments from the database.";
        file_put_contents('PDOErrors.txt', 'deletedata.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

    // delete ratings
    $sql = 'DELETE FROM Ratings WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    } catch (PDOException $e){
        echo "Could not delete ratings from the database.";
        file_put_contents('PDOErrors.txt', 'deletedata.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

    // delete MediaItemTags
    $sql = 'DELETE FROM MediaItemTags WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    } catch (PDOException $e){
        echo "Could not delete MediaItemTags from the database.";
        file_put_contents('PDOErrors.txt', 'deletedata.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

    // delete MediaItems
    $sql = 'DELETE FROM MediaItems WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
        $DBH->commit();
        header('Location: index.php?success=Item deleted');
    } catch (PDOException $e){
        echo "Could not delete data from the database.";
        file_put_contents('PDOErrors.txt', 'deletedata.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

} else {
    header('Location: index.php?success=No hacking allowed.');
}