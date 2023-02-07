<?php
    $type = $_GET['t'] ?? 1;
    $detail = $_GET['d'] ?? null;
    $texts = [
        1 => '健康新知',
        2 => '菸害防治',
        3 => '癌症防治',
        4 => '慢性病防治',
    ];

    $news = db_all('news', [ 'type' => $type, 'sh' => 1 ], [ 'order' => 'id' ]);
?>
<style>
    .po td {
        vertical-align: top;
    }
</style>
<fieldset>
    <legend>
        目前位置：首頁 ＞ 分類網誌 ＞ <?= $texts[$type] ?>
    </legend>

    <table class="po">
        <tr>
            <td>
                <fieldset>
                    <legend>分類網誌</legend>
                    <a href="?do=po&t=1"><?= $texts[1] ?></a><br/>
                    <a href="?do=po&t=2"><?= $texts[2] ?></a><br/>
                    <a href="?do=po&t=3"><?= $texts[3] ?></a><br/>
                    <a href="?do=po&t=4"><?= $texts[4] ?></a>
                </fieldset>
            </td>
            <td>
                <fieldset>
                    <legend>文章列表</legend>
                    <?php foreach($news as $new): ?>
                        <div><a href="?do=po&t=<?= $new['type'] ?>&d=<?= $new['id'] ?>"><?= $new['title'] ?></a></div>
                    <?php endforeach ?>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php if ($detail != null): ?>
                    <?php foreach($news as $new): ?>
                        <?php if($new['id'] === $detail): ?>
                            <fieldset>
                                <pre>
<?= $new['text'] ?>
                                </pre>
                            </fieldset>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>
    </table>
</fieldset>