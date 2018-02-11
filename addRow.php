<?php

try {
    //соединение с БД
    $dbcon = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $uname = $_POST['user_name'];
    $tcomment = $_POST['comment'];
    $data = $dbcon->prepare("INSERT INTO posts (
            name, text_comment) VALUES (:uname, :tcomment)"
    );
    $data->bindParam(':uname', $uname);
    $data->bindParam(':tcomment', $tcomment);

    unset($_POST['user_name']);
    unset($_POST['comment']);

    $data->execute();

} catch(PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
unset($dbcon);
header('Location: index.php');
?>