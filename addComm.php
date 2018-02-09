<?php

try {
    //$id = @$_POST['id'];
    //if(empty($id){
    //echo "<typescript>alert('no id - pipec')</typescript><br>";
    //exit(1);
    //}

    $dbconToComm = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $dbconToComm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $author = $_POST['author_comm'];
    $text = $_POST['text_comment'];
    $id_post = $_POST['id_comm'];

    //var_export($id_post);
    $data = $dbconToComm->prepare("INSERT INTO commenttopost (
            nameCom, text, post_id) VALUES (:author, :text, :id_post)"
    );
    $data->bindParam(':author', $author);
    $data->bindParam(':text', $text);
    //$data->bindParam(':id_post',$id);

    unset($_POST['author_comm']);
    unset($_POST['text_comment']);
    unset($_POST['id_comm']);

    $data->execute();

} catch(PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
unset($dbcon);
header('Location: cmmentPage.php?id={$id}');
?>
