<?php
    include_once('../base.php');

    $dels = $_POST['del'] ?? null;

    foreach($dels as $id) {
        db_delete('user', $id);
    }

    header('location: /back.php?do=user');