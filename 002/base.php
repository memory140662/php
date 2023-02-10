<?php
    session_start();

    $user = $_SESSION['user'] ?? null;
	$is_login = $user !== null;
	$is_admin = $user === 'admin';
    
    $conn = new PDO('mysql:host=localhost;charset=utf8;dbname=db20', 'root', 'root');

    function db_all($table, $param = [], $option = []) {
        global $conn;

        $sql = 'SELECT * FROM ' . $table . " WHERE 1 = 1 ";

        if (is_array($param)) {
            foreach($param as $key => $value) {
                $sql .= ' AND ' . $key . ' = "' . $value . '" ';
            }
        }

        if (isset($option['order'])) {
            $sql .= ' ORDER BY ' . $option['order'];
        }

        if (isset($option['limit'])) {
            $sql .= ' LIMIT ' . $option['limit'];
        }

        if (isset($option['offset'])) {
            $sql .= ' OFFSET ' . $option['offset'];
        }

        $state = $conn->query($sql);

        return $state->fetchAll(PDO::FETCH_ASSOC);
    }

    function db_get($table, $param = []) {
        global $conn;

        $sql = 'SELECT * FROM ' . $table . ' WHERE 1 = 1 ';

        if (is_array($param)) {
            foreach($param as $key => $value) {
                $sql .= ' AND ' . $key . ' = "' . $value . '" ';
            }
        } else {
            $sql .= ' AND id = "' . $param . '"';
        }

        $sql .= ' LIMIT 1 ';        

        $state = $conn->query($sql);

        return $state->fetch(PDO::FETCH_ASSOC);
    }

    function db_count($table, $param = []) {
        global $conn;

        $sql = 'SELECT COUNT(*) FROM ' . $table . ' WHERE 1 = 1 ';

        if (is_array($param)) {
            foreach($param as $key => $value) {
                $sql .= ' AND ' . $key . ' = "' . $value . '" ';
            }
        }

        $sql .= ' LIMIT 1 ';        

        $state = $conn->query($sql);

        return $state->fetchColumn();
    }

    function db_delete($table, $param = []) {
        global $conn;

        $sql = ' DELETE FROM ' . $table . ' WHERE 1 = 1 ';

        if (is_array($param)) {
            foreach($param as $key => $value) {
                $sql .= ' AND ' . $key . ' = "' . $value . '" ';
            }
        } else {
            $sql .= ' AND id = "' . $param . '"';
        }

        return $conn->exec($sql);
    }

    function db_save($table, $param = []) {
        global $conn;

        $id = $param['id'] ?? null;

        $sql = '';

        if ($id) {
            $temp = [];
            foreach($param as $key => $value) {
                $temp[] = $key . ' = "' . $value . '"';
            }

            $sql .= ' UPDATE ' . $table;
            $sql .= ' SET ' . join(', ', $temp);
            $sql .= ' WHERE id = "' . $id . '"';
        } else {
            $sql .= ' INSERT INTO ' . $table;
            $sql .= ' (' . join(', ', array_keys($param)) . ')';
            $sql .= ' VALUES("' . join('", "', $param) . '")';
        }

        return $conn->exec($sql);
    }

    function db_query($sql, $param = []) {
        global $conn;

        $state = $conn->prepare($sql);
        
        if (is_array($param)) {
            $state->execute($param);
        }

        return $state->fetchAll(PDO::FETCH_ASSOC);
    }

    function back() {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    function to($url) {
        header('location: ' . $url);
    }

    function getMsg() {
        $msg = $_SESSION['m'] ?? '';

        unset($_SESSION['m']);

        return $msg;
    }

    function setMsg($msg) {
        $_SESSION['m'] = $msg;
    }

    $today = date('Y-m-d');

	if (!isset($_SESSION['total_' . $today])) {
		$total = db_get('total', [ 'date' => $today ]);
        
        $total['date'] = $today;
        $total['total'] = ($total['total'] ?? 0) + 1;

        db_save('total', $total);

		$_SESSION['total_' . $today] = true;
	}

	$today_total = db_get('total', [ 'date' => $today ])['total'];
	$total = db_query('SELECT SUM(total) total FROM total')[0]['total'];