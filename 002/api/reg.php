<?php
    include_once('../base.php');

    $ac = $_POST['ac'] ?? null;
    $pw = $_POST['pw'] ?? null;
    $cpw = $_POST['cpw'] ?? null;
    $email = $_POST['email'] ?? null;
    $is_back = $_GET['back'] ?? null;

    if (!$ac) {
        setMsg('帳號不可為空');
        back();
        exit;
    }
    if (!$pw) {
        setMsg('密碼不可為空');
        back();
        exit;
    } 
    
    if (!$email) {
        setMsg('信箱不可為空');
        back();
        exit;
    } 
    
    if ($pw != $cpw) {
        setMsg('密碼錯誤');
        back();
        exit;
    }

    $count = db_count('user', [ 'acc' => $ac ]);

    if ($count > 0) {
        setMsg('帳號重複');
        back();
        exit;
    }

    db_save('user', [ 'acc' => $ac , 'pw' => $pw, 'email' => $email ]);

    if ($is_back) {
        back();
        exit;
    }
    
    setMsg('註冊完成，歡迎加入');
    to('/?do=login');