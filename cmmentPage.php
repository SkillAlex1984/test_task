<h1>Полный текст поста</h1>
<p style="border: 4px double black; width: 600px">пост
    <?php
    $id = $_GET['id'];
    $dbcon = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $commText = $dbcon->query("SELECT * from posts WHERE id = {$id}");
    $commText->setFetchMode(PDO::FETCH_ASSOC);
    $piseText = '';
    while ($row = $commText->fetch()) {

        echo "Дата:" . $row['date'] . $row['name'] . $row['text_comment'] . "<br>" . "<br>";
    }
    //var_export($commText);
    ?>
</p>

<h2 align="right">Комментрий к посту</h2>

<?php
$id = $_GET['id'];
$dbcon = new PDO
('mysql:host=localhost; dbname=comments', 'root', '');
$commText = $dbcon->query("SELECT text FROM commenttopost 
                                     JOIN posts p ON commenttopost.post_id = p.id 
                                     WHERE commenttopost.post_id = {$id}");
$commText->setFetchMode(PDO::FETCH_ASSOC);

while ($row = $commText->fetch()) {

    echo $row['text'] . "<br>";
}

?>
</p>
<form action='addComm.php?id={$id}' method="post">
    <label> Автор коментария <input name='author_comm' required></label>
    <label> Текст комментария <input name='text_comment' required> </label>


    <button type="submit"> Добавить комментарий</button>
</form>
