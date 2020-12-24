<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 11.05.2019
 * Time: 22:11
 */

require_once 'modules/connectbd.php';
//Создаем таблицу с вопросами
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS questions(
                                                                id INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                                question VARCHAR(255)NOT NULL DEFAULT '',
                                                                answer_1 TEXT,
                                                                answer_2 TEXT,
                                                                answer_3 TEXT,
                                                                answer_4 TEXT,
                                                                true_anser TEXT
                                                                )"))  {
    echo "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
}
//Создаем таблицу с тестами
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS tests(
                                                                id INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                                name_test VARCHAR(255)NOT NULL DEFAULT '',
                                                                questions_list TEXT
                                                                )"))  {
    echo "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
}

//Создаем таблицус с результатами тестов
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS result_test(
                                                                id INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                                user_answers TEXT,
                                                                mark INT(3),
                                                                count_all INT(3),
                                                                time_start DATETIME NOT NULL,
                                                                time_end DATETIME NOT NULL,
                                                                link VARCHAR(100)
                                                                )"))  {
    echo "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
}