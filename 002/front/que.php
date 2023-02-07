<?php
    $ques = db_all('que', [ 'subject_id' => 0 ], [ 'order' => 'id' ]);
?>
<fieldset>
    <legend>目前位置：首頁 ＞ 問卷調查</legend>
    <table>
        <thead>
            <tr>
                <th>編號</th>
                <th>問卷題目</th>
                <th>投票總數</th>
                <th>結果</th>
                <th>狀態</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ques as $idx => $que): ?>
                <tr>
                    <td><?= $idx + 1 ?>.</td>
                    <td><?= $que['text'] ?></td>
                    <td><?= $que['count'] ?></td>
                    <td><a href="?do=result&id=<?= $que['id'] ?>">結果</a></td>
                    <td>
                        <?php if($is_login): ?>
                            <a href="?do=vote&id=<?= $que['id'] ?>">參與投票</a>
                        <?php else: ?>
                            請先登入
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</fieldset>