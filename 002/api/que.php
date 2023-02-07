<?php
    include_once('../base.php');

    $subject = $_POST['subject'];
    $ques = $_POST['que'];

    db_save('que', [ 'text' => $subject, 'count' => 0, 'subject_id' => 0 ]);
    $subject_id = db_get('que', [ 'text' => $subject ])['id'];

    foreach ($ques as $que) {
        db_save('que', [ 'text' => $que, 'subject_id' => $subject_id, 'count' => 0 ]);
    }

    to('/back.php?do=que');