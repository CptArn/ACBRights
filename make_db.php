<?php
    $db = new SQLite3('ACBRights.db');
    // $db->exec('DROP TABLE IF EXISTS t_users');
    // $db->exec('DROP TABLE IF EXISTS t_roles');
    // $db->exec('DROP TABLE IF EXISTS t_user_has_roles');
    // $db->exec('DROP TABLE IF EXISTS t_courses');
    // $db->exec('DROP TABLE IF EXISTS t_course_divisions');
    // $db->exec('DROP TABLE IF EXISTS t_lessons');
    // $db->exec('DROP TABLE IF EXISTS t_course_division_has_lessons');
    // $db->exec('DROP TABLE IF EXISTS t_course_has_course_divisions');
    // $db->exec('DROP TABLE IF EXISTS t_grades');

    $db->exec('CREATE TABLE IF NOT EXISTS t_users (id INTEGER PRIMARY KEY, name NVARCHAR(250))');
    $db->exec('CREATE TABLE IF NOT EXISTS t_roles (id INTEGER PRIMARY KEY, role_name NVARCHAR(50), role_description NVARCHAR(250))');
    $db->exec('CREATE TABLE IF NOT EXISTS t_user_has_roles (id INTEGER PRIMARY KEY, role_id INTEGER, user_id INTEGER, FOREIGN KEY(role_id) REFERENCES t_roles(id), FOREIGN KEY(user_id) REFERENCES t_users(id))');
    $db->exec('CREATE TABLE IF NOT EXISTS t_courses (id INTEGER PRIMARY KEY, name NVARCHAR(250))');
    $db->exec('CREATE TABLE IF NOT EXISTS t_course_divisions (id INTEGER PRIMARY KEY, name NVARCHAR(250))');
    $db->exec('CREATE TABLE IF NOT EXISTS t_lessons (id INTEGER PRIMARY KEY, name NVARCHAR(250))');
    $db->exec('CREATE TABLE IF NOT EXISTS t_course_division_has_lessons (course_division_id INTEGER KEY, lesson_id INTEGER KEY)');
    $db->exec('CREATE TABLE IF NOT EXISTS t_course_has_course_divisions (course_division_id INTEGER KEY, course_id INTEGER KEY)');
    $db->exec('CREATE TABLE IF NOT EXISTS t_grades (id INTEGER PRIMARY KEY, user_id INTEGER, lesson_id INTEGER, scoring NVARCHAR(250))');
?>