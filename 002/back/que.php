<script>
    $(function() {
        $('#btnMore').click(function() {
            $('#que .detail').append('<br data-temp/><span data-temp>選項</span><input data-temp type="text" name="que[]">');
        });

        $('button[type=reset]').on('click', function() {
            $('#que .detail [data-temp]').remove();
        });
    });
</script>
<fieldset>
    <legend>新增問卷</legend>
    <form action="/api/que.php" method="post">
        <table id="que">
            <tr>
                <th>問卷名稱</th>
                <td><input type="text" name="subject"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="detail">
                        選項<input type="text" name="que[]">
                    </span>
                    <button type="button" id="btnMore">更多</button>
                </td>
            </tr>
        </table>
        <button>新增</button>|<button type="reset">清空</button>
    </form>
</fieldset>