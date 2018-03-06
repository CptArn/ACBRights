<?php
    function GetAllLessons() {
        $db = new SQLite3('ACBRights.db');
        $sth = $db->prepare('select * from t_lessons');
        $sth->execute();
        $result = $sth->sqlite_fetch_assoc();

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    function GetAllUsers() {
        $db = new SQLite3('ACBRights.db');
        $users = $db->query('select * from t_users');

        while ($row = $users->fetchArray()) {
            var_dump($row);
        }
    }


    $action = $_GET['action'];
    

    switch($action) {
        case 'lessons': GetAllLessons();
        case 'users': GetAllUsers();
    }

?>