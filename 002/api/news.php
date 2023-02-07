<?php
    include_once('../base.php');

    $ids = $_POST['id'] ?? null;
    $dels = $_POST['del'] ?? null;

    if ($dels) {
        foreach ($dels as $id) {
            db_delete('news', $id);
        }
    }
    
    foreach($ids as $id) {
        if (isset($_POST['sh_' . $id])) {
            db_save('news', [ 'id' => $id, 'sh' =>  1 ]);
        } else {
            db_save('news', [ 'id' => $id, 'sh' =>  0 ]);
        }
    }

    to('/back.php?do=news');