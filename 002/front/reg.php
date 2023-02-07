<script>
    var msg = '<?= getMsg() ?>';
    if (msg) {
        alert(msg);
    }
</script>

<fieldset>
    <legend>會員註冊</legend>
    <form action="/api/reg.php" method="post">
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
        <button>註冊</button>
        <button type="reset">清除</button>
    </form>
</fieldset>