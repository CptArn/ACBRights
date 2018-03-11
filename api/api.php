<?php
    if ((!is_array($_POST)) || (count($_POST) < 1)) {
        $_POST = json_decode(file_get_contents('php://input'), true);
    }

    function GetDb() {
        return new PDO('sqlite:../db/ACB.db');
    }

    function GetAllLessons() {
        $db = GetDb();
        $sth = $db->prepare('select * from t_lessons');
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    function GetAllUsers() {
        $db = GetDb();
        $users = $db->query('select * from t_users');

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    function GetFullCourse($id) {
        $db = GetDb();
        $sth = $db->prepare('select l.id, l.name as lesson_name, cd.name as course_division_name, c.name as course_name, cd.id as course_division_id from t_courses as c inner join t_course_has_course_divisions chcd on c.id = chcd.course_id inner join t_course_divisions cd on chcd.course_division_id = cd.id inner join t_course_division_has_lessons cdhl on cd.id = cdhl.course_division_id inner join t_lessons l on cdhl.lesson_id = l.id where course_id = ? order by lesson_name ASC');
        $sth->execute(array($id));

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        $course_object = new stdClass();
        $course_object->course_division = array();
        $course_object->name = $result[0]['course_name'];

        foreach($result as $row) {
            if (!isset($course_object->course_division[$row['course_division_id']])) {
                $course_division = new stdClass();
                $course_division->lessons = array();
                $course_division->name = $row['course_division_name'];
                $course_object->course_division[$row['course_division_id']] = $course_division;
            }
            $lesson = new stdClass();
            $lesson->id = $row['id'];
            $lesson->name = $row['lesson_name'];
            array_push($course_object->course_division[$row['course_division_id']]->lessons, $lesson);
        }

        header('Content-Type: application/json');
        echo json_encode($course_object);
    }

    function CreateLesson($name) {
        $db = GetDb();
        $sth = $db->prepare('INSERT INTO t_lessons (name) values (?)');
        $sth->execute(array($name));

        header('Content-Type: application/json');
        echo json_encode(array());
    }

    function CreateCourseDivision($name) {
        $db = GetDb();
        $sth = $db->prepare('INSERT INTO t_course_divisions (name) values (?)');
        $sth->execute(array($name));

        header('Content-Type: application/json');
        echo json_encode(array());
    }

    function CreateCourse($name) {
        $db = GetDb();
        $sth = $db->prepare('INSERT INTO t_courses (name) values (?)');
        $sth->execute(array($name));

        header('Content-Type: application/json');
        echo json_encode(array());
    }


    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
        switch($action) {
            case 'lessons': GetAllLessons(); break;
            case 'users': GetAllUsers(); break;
            case 'fullcourse': isset($_GET['course_id']) ? GetFullCourse($_GET['course_id']): ''; break;
            default: break;
        }
    }

    if ($method === 'POST') {
        switch($action) {
            case 'lesson': isset($_POST['name']) ? CreateLesson($_POST['name']): ''; break;
            case 'courseDivision': isset($_POST['name']) ? CreateCourseDivision($_POST['name']): ''; break;
            case 'course': isset($_POST['name']) ? CreateCourse($_POST['name']): ''; break;
        }
    }

?>