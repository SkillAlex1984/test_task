<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8_general_ci">
    <title>БЛОГ</title>

</head>
<body>

<h1>Здесь будет список комментариев</h1>


<?php
include 'base.html';
$dbcon = new PDO
('mysql:host=localhost; dbname=comments', 'root', '');
$data = $dbcon->query('SELECT * FROM commenttopost 
                                     JOIN posts p ON commenttopost.post_id = p.id 
                                     GROUP BY commenttopost.post_id
                                     ORDER BY commenttopost.post_id
                                     DESC LIMIT 0,5');

$data->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $data->fetch()) {
    echo "Дата: " . $row['date'] . "Имя: " . $row['name'] . "Текст поста: " . $row['text_comment'] . "<br>";
}


?>
</p>

<p style="border: 4px double black;"><strong>Список всех записей только здесь надо переделать селект по колву
        коментариев:</strong><br>
    <?php
    $dbcon = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $dataAllList = $dbcon->query('SELECT p.id, p.date, p.name, p.text_comment, COUNT(c.post_id) as  cnt FROM posts as p
                                            JOIN commenttopost as c ON p.id = c.post_id
                                            GROUP BY p.id, p.date, p.name, p.text_comment                                           
                                            ');
    $dataAllList->setFetchMode(PDO::FETCH_ASSOC);
    $piseText = '';
    while ($row = $dataAllList->fetch()) {
        $piseText = substr($row['text_comment'], 0, 100);
        echo "Дата:" . $row['date'] . $row['name'] . $piseText . " Колличество комментариев " . $row['cnt'] . "<br>"
            . "<a href='cmmentPage.php?id={$row['id']}'> Подробнее </a>" . "<br>";

    }
    ?>

</p>

<form action='addRow.php' method="post" role="form" class="form-inline">
    <label> Имя <input name='user_name' required></label>
    <label> Комментарий <input name='comment' required> </label>

    <button type="submit"> Сохранить</button>

</form>
</body>
</html>

