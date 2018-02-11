<h1>Полный текст поста</h1>
<div class="row">
    <div class="col-xs-6">
        <?php
        include 'base.html';
        $id = $_GET['id'];
        $dbcon = new PDO
        ('mysql:host=localhost; dbname=comments', 'root', '');
        $commText = $dbcon->query("SELECT * from posts WHERE id = {$id}");
        $commText->setFetchMode(PDO::FETCH_ASSOC);
        $piseText = '';
        while ($row = $commText->fetch()) {
            echo "Автор поста:" . $row['name'] . "<br>" . $row['text_comment'] . "<br>";
        }
        ?>
    </div>
    <div class="col-xs-6">
        <h2>Комментрий к посту</h2>

        <?php
        $id = $_GET['id'];
        $dbcon = new PDO
        ('mysql:host=localhost; dbname=comments', 'root', '');
        $commText = $dbcon->query("SELECT * FROM commenttopost 
                                     JOIN posts p ON commenttopost.post_id = p.id 
                                     WHERE commenttopost.post_id = {$id}");
        $commText->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $commText->fetch()) {

            echo "Имя: " . $row['nameCom'] . "Текст комментария: " . $row['text'] . "<br>";
        }
        ?>
    </div>
</div>


<form action='addComm.php' method="post">
    <label> Автор коментария <input name='author_comm' required></label>
    <label> Текст комментария <input name='text_comment' required> </label>
    <input hidden name="post_id" value=<?= $id ?>>
    <button type="submit"> Добавить комментарий</button>
</form>