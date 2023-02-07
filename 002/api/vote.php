<?php

    include_once('../base.php');

    $subject_id = $_POST['subject_id'];
    $id = $_POST['id'];

    $subject = db_get('que', $subject_id);
    $que = db_get('que', $id);

    db_save('que', [ 'id' => $subject_id, 'count' => $subject['count'] + 1 ]);
    db_save('que', [ 'id' => $id, 'count' => $que['count'] + 1 ]);

    to('/?do=result&id=' . $subject_id);