<?php
try {
    $dbconToComm = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $dbconToComm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $author = $_POST['author_comm'];
    $text = $_POST['text_comment'];
    $id_post = $_POST['post_id'];

    var_export($id_post);
    var_export($author);
    var_export($text);
    $data_com = $dbconToComm->prepare("INSERT INTO commenttopost (
            nameCom, text, post_id) VALUES (:author, :text, :post_id)"
    );
    $data_com->bindParam(':author', $author);
    $data_com->bindParam(':text', $text);
    $data_com->bindParam(':post_id', $id_post);

    unset($_POST['author_comm']);
    unset($_POST['text_comment']);
    unset($_POST['post_id']);

    $data_com->execute();

} catch(PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();

}
header("Location: cmmentPage.php?id={$id_post}");
?>