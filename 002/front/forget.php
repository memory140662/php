<?php
    $m = getMsg();
?>
<fieldset>
    <form action="/api/forget.php" method="post">
        請輸入信箱以查詢密碼<br/>
        <input type="text" name="email"/><br/>
        <?php if($m): ?>
            <?= $m ?><br/>
        <?php endif ?>
        <button>尋找</button>
    </form>
</fieldset>