<?php
    $page = $_GET['p'] ?? 0;
    $news = db_all('news', [ 'sh' => 1 ], [ 'order' => 'good desc', 'limit' => 5, 'offset' => $page * 5]);
    $total = db_count('news');
?>
<fieldset>
    <legend>
        目前位置：首頁 ＞ 人氣文章區
    </legend>

    <table>
        <thead>
            <tr>
                <th>標題</th>
                <th>內容</th>
                <th>人氣</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($news as $new): ?>
                <tr title="<?= $new['text'] ?>" >
                    <td><?= $new['title'] ?></td>
                    <td><div style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; width: 300px"><?= $new['text'] ?></div></td>
                    <td>
                        <?= $new['good'] ?>個人說<img src="./icon/02B03.jpg" alt="" width="30px" height="30px">
                        <?php if($is_login): ?>
                            -
                            <?php if(db_count('good', [ 'news' => $new['id'], 'user' => $_SESSION['user'] ]) > 0): ?>
                                <a href="/api/good.php?id=<?= $new['id'] ?>&type=unlink">收回讚</a>
                            <?php else: ?>
                                <a href="/api/good.php?id=<?= $new['id'] ?>&type=like">讚</a>
                            <?php endif ?>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="p">
        <?php if($page > 0): ?>
            <a href="?do=news&p=<?= $page - 1 ?>"><</a>
        <?php endif ?>
        <?php for($i = 0; $i < ceil($total / 5); $i++): ?>
            <a href="?do=news&p=<?= $i ?>" <?= $i == $page ? 'class="active"' : '' ?>><?= $i + 1 ?></a>
        <?php endfor ?>
        <?php if($page + 1 < ($total / 5)): ?>
            <a href="?do=news&p=<?= $page + 1 ?>">></a>
        <?php endif ?>
    </div>
</fieldset>