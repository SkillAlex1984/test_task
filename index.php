<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8_general_ci">
    <title>БЛОГ</title>

</head>
<body>
<h1>Cписок комментариев</h1>

<p style="border: 4px double black;"><strong>Список популярное:</strong><br>

    <?php

    $dbcon = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $data = $dbcon->query('SELECT * from posts ORDER BY date DESC LIMIT 1, 5');
    $data->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $data->fetch()) {
        echo $row['date'] . $row['name'] . $row['text_comment'] . "<br>";
    }
    ?>
</p>

<p style="border: 4px double black;"><strong>Список всех постов:</strong><br>
    <?php
    $dbcon = new PDO
    ('mysql:host=localhost; dbname=comments', 'root', '');
    $dataAllList = $dbcon->query('SELECT * from posts ORDER BY date DESC');
    $dataAllList->setFetchMode(PDO::FETCH_ASSOC);
    $piseText = '';
    
    while ($row = $dataAllList->fetch()) {
        $piseText = substr($row['text_comment'], 0, 10);
        echo "Дата:" . $row['date'] . $row['name'] . $piseText . "<br>" . "<a href='cmmentPage.php?id={$row['id']}'> Подробнее </a>" . "<br>";
    }
    ?>

</p>

<form action='addRow.php' method="post">
    <label> Имя <input name='user_name' required></label>
    <label> Пост <input name='comment' required> </label>

    <button type="submit"> Сохранить</button>

</form>
</body>
</html>
