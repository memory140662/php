<?php
    include_once('../base.php');

    $id = $_GET['id'] ?? null;
    $type = $_GET['type'] ?? null;

    if ($id && $type) {
        $new = db_get('news', $id);
        $good = $new['good'] ?? 0;

        if ($type == 'like') {
            db_save('news', [ 'id' => $id, 'good' => $good + 1 ]);
            db_save('good', [ 'news' => $id, 'user' => $user ]);
        } else if ($good > 0) {
            db_save('news', [ 'id' => $id, 'good' => $good - 1 ]);
            db_delete('good', [ 'news' => $id, 'user' => $user ]);
        }
    }

    back();