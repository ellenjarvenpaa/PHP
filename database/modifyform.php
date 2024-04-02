<?php

global $DBH;
require_once 'dbconnect.php';

if (isset($_GET['id'])) {
    $sql = 'SELECT * FROM MediaItems WHERE media_id = :media_id';

    $data = [
            'media_id' => $_GET['id']
    ];

    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        header('Location: index.php?success=Item added');
    } catch (PDOException $e){
        echo "Could not get data from the database.";
        file_put_contents('PDOErrors.txt', 'modifyform.php - ' . $e->getMessage(), FILE_APPEND);
        exit;
    }
}

?>

<section>
    <form action="modifydata.php" method="post">
        <input type="hidden" name="media_id" value="<?php echo $row['media_id']; ?>">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">value="<?php echo $row['description']; ?>"</textarea>
        </div>
        <div>
            <input type="submit" value="Save">
        </div>
    </form>
</section>