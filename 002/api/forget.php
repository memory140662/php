<?php
    include_once('../base.php');

    $email = $_POST['email'] ?? null;

    $user = db_get('user', [ 'email' => $email ]);
    
    setMsg($user ? '您的密碼為: ' . $user['pw'] : '查無此資料');
    to('/?do=forget');