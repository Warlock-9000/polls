<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 20:30
 */

$title = 'Прохождение тестов Онлайн';
$header = "Сайт тестов";
$id='';
if (isset($_REQUEST['id'])){
    $id = strtolower(strip_tags(trim($_GET['id'])));
}
// Инициализация заголовков страницы
switch($id){
    case 'testpage':
        $title = 'Страница тестирования';
        $header = 'Страница Теста';
        break;
    case 'result':
        $title = 'Результаты теста';
        $header = 'Результат теста';
        break;
}