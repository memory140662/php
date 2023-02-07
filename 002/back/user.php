<?php 
    $users = db_all('user', null, [ 'order' => 'id' ]);
?>
<script>
    var msg = '<?= getMsg() ?>';
    if (msg) {
        alert(msg);
    }
</script>
<fieldset>
    <legend>帳號管理</legend>
    <form action="/api/del_user.php" method="post">
        <div>
            <table >
                <thead>
                    <tr>
                        <th>帳號</th>
                        <th>密碼</th>
                        <th>刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['acc'] ?></td>
                            <td><?= str_repeat('*', strlen($user['pw'])) ?></td>
                            <td><input type="checkbox" name="del[]" value="<?= $user['id'] ?>"></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <button>確定刪除</button>
            <button type="reset">清空選取</button>
        </div>
    </form>
    <div>
        <h1>新增會員</h1>
        <form action="/api/reg.php?back=1" method="post">
        <p>*請設定您要註冊的帳號及密碼（最長 12 個字元）</p>
        <table>
            <tr>
                <th>Step1:登入帳號</th>
                <td><input type="text" name="ac" maxlength="12"/></td>
            </tr>
            <tr>
                <th>Step2:登入密碼</th>
                <td><input type="password" name="pw" maxlength="12"/></td>
            </tr>
            <tr>
                <th>Step3:再次確認密碼</th>
                <td><input type="password" name="cpw" maxlength="12"/></td>
            </tr>
            <tr>
                <th>Step4:信箱(忘記密碼時使用)</th>
                <td><input type="text" name="email"/></td>
            </tr>
        </table>
        <button>新增</button>
        <button type="reset">清除</button>
    </form>
    </div>
</fieldset>