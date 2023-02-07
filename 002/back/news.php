<?php
    $page = $_GET['p'] ?? 0;

    $news = db_all('news', null, [ 'offset' => $page * 3, 'limit' => 3, 'order' => 'id']);
    $total = db_count('news');
?>
<fieldset>
    <form action="/api/news.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>編號</th>
                    <th>標題</th>
                    <th>顯示</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($news as $new): ?>
                    <tr>
                        <td>
                            <?= $new['id'] ?>.
                            <input type="hidden" name="id[]" value="<?= $new['id'] ?>">
                        </td>
                        <td><?= $new['title'] ?></td>
                        <td><input type="checkbox" name="sh_<?= $new['id'] ?>" <?= $new['sh'] ? 'checked' : '' ?>></td>
                        <td><input type="checkbox" name="del[]" value="<?= $new['id'] ?>"></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="p">
            <?php if($page > 0): ?>
                <a href="/back.php?do=news&p=<?= $page - 1 ?>"><</a>
            <?php endif ?>
            <?php for($i = 0; $i < ceil($total / 3); $i++): ?>
                <a href="/back.php?do=news&p=<?= $i ?>" <?= $i == $page ? 'class="active"' : '' ?>><?= $i + 1 ?></a>
            <?php endfor ?>
            <?php if($page + 1 < ($total / 3)): ?>
                <a href="/back.php?do=news&p=<?= $page + 1 ?>">></a>
            <?php endif ?>
        </div>
        <button>確定修改</button>
    </form>
</fieldset>