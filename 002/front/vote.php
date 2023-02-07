<?php
    $id = $_GET['id'] ?? null;
    $que = db_get('que', $id);
    $total = $que['count'] ?? 0;

    $ques = db_all('que', [ 'subject_id' => $id ], [ 'order' => 'id' ]);
?>
<fieldset>
    <legend>目前位置：首頁 ＞ 問卷調查 ＞ <?= $que['text'] ?></legend>
    <h3><?= $que['text'] ?></h3>
    <form action="/api/vote.php" method="post">
        <input type="hidden" name="subject_id" value="<?= $id ?>">
        <?php foreach($ques as $idx => $que): ?>
            <div>
                <input id="<?= $que['id'] ?>" type="radio" name="id" value="<?= $que['id'] ?>"/>
                <label for="<?= $que['id'] ?>"><?= $que['text'] ?></label>
            </div>
        <?php endforeach ?>
        <div>
            <button>我要投票</button>
        </div>
    </form>
</fieldset>