<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 11.05.2019
 * Time: 20:20
 */

//Включаем отображение ошибок
ini_set('display_errors', true);
//Стартуем сессию
session_start();
include 'modules/headers.php';
require_once 'modules/connectbd.php';
?>

<!DOCTYPE html>
<html>
<head>

    <title><?= $title?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--    different css-->
    <link rel="stylesheet" href="inc/style.css" />
</head>
<body>
<div id="header">
    <!-- Верхняя часть страницы -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Заголовок -->
                <h1><?= $header?></h1>
<!--                Меню-->

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="/">Главная</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item ">
                                <a class="nav-link" href="?id=addquestion">Добавить вопросы в БД <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?id=addtest">Создать тесты</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
        </div>
    </div>
</div>

    <!--Основной контент страницы-->
<div id="content">
    <?php
    include 'modules/routing.php';
    ?>
</div>

<div id="footer">
    <!-- Нижняя часть страницы -->
   <?php require_once 'inc/footer.php' ?>
    <!-- Нижняя часть страницы -->
</div>
