<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 19:59
 */

require_once 'config.php';

$mysqli= new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DB, MYSQL_PORT);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
    exit;
}
//echo "Соединение с MySQL установлено!" . PHP_EOL;
//echo "Информация о сервере: " . mysqli_get_host_info($mysqli) . PHP_EOL;
