<?php
    include_once('../base.php');

    $ac = $_POST['ac'] ?? null;
    $pw = $_POST['pw'] ?? null;

    $user = db_get('user', ['acc' => $ac ]);

    if (!$user) {
        setMsg('查無帳號');
        to('/?do=login');
        exit;
    }

    if ($user['pw'] != $pw) {
        setMsg('密碼錯誤');
        to('/?do=login');
        exit;
    } 

    $_SESSION['user'] = $ac;
    to($ac == 'admin' ? '/back.php' : '/');
    
