<script>
    var msg = '<?= getMsg() ?>';
    if (msg) {
        alert(msg);
    }
</script>

<fieldset>
    <legend>會員登入</legend>
    <form action="/api/login.php" method="post">
        <table>
            <tr>
                <th>帳號</th>
                <td><input type="text" name="ac" /></td>
            </tr>
            <tr>
                <th>密碼</th>
                <td><input type="password" name="pw" /></td>
            </tr>
            <tr>
                <td>
                    <button>登入</button>
                    <button type="reset">清除</button>
                </td>
                <td>
                    <a href="?do=forget">忘記密碼</a>
                    | <a href="?do=reg">尚未註冊</a>
                </td>
            </tr>
        </table>
    </form>
</fieldset>