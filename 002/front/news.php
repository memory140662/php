<?php
    $page = $_GET['p'] ?? 0;
    $news = db_all('news', [ 'sh' => 1 ], [ 'order' => 'id', 'limit' => 5, 'offset' => $page * 5 ]);
    $total = db_count('news');
?>
<script>
    function showDetail(target) {
        if ($(target).find('div').css('white-space') === 'nowrap') {
            $(target).find('div').css('white-space', '');
        } else {
            $(target).find('div').css('white-space', 'nowrap');
        }
    }

    $(function() {
        $('a[href]').click(function(e) {
            e.stopPropagation();
        })
    });
</script>
<style>
    #news td {
        vertical-align: top;
    }
</style>
<fieldset>
    <legend>
        目前位置：首頁 ＞ 最新文章區
    </legend>

    <table id="news">
        <thead>
            <tr>
                <th>標題</th>
                <th>內容</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($news as $new): ?>
                <tr onclick="showDetail(this);">
                    <td><?= $new['title'] ?></td>
                    <td><div style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; width: 200px"><?= $new['text'] ?></div></td>
                    <td> 
                        <?php if($is_login): ?>
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