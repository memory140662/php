<?php
    $id = $_GET['id'] ?? null;
    $que = db_get('que', $id);
    $total = $que['count'] ?? 0;

    $ques = db_all('que', [ 'subject_id' => $id ], [ 'order' => 'id' ]);
?>
<fieldset>
    <legend>目前位置：首頁 ＞ 問卷調查 ＞ <?= $que['text'] ?></legend>
    <h3><?= $que['text'] ?></h3>
    <table>
        <?php foreach($ques as $idx => $que): ?>
            <?php $rate = round(($total > 0 ? ($que['count'] / $total) : 0), 2) ?>
            <tr>
                <td><?= $idx + 1 ?>.<?= $que['text'] ?></td>
                <td>
                    <span style="display: inline-block; background: gray; height: 20px; width: <?= 200 * $rate ?>px;"></span>
                    <?= $que['count'] ?> 票
                    (<?= $rate * 100 ?>%)
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div>
        <a href="/?do=que">返回</a>
    </div>
</fieldset>