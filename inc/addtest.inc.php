<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 22:45
 */

if (isset($_POST['nametest'])){
    $nametest=$_POST['nametest'];
    $questionsid=$_POST['questionid'];
    if (empty($questionsid)){
        echo 'Надо было выбрать вопросы';
        die();
    }
    $questionsid=json_encode($questionsid);
    if (!$mysqli->query("INSERT INTO `tests`(`name_test`, `questions_list`)
                                VALUES('$nametest','$questionsid') "))  {
        echo "Что-то пошло не так!: (" . $mysqli->errno . ") " . $mysqli->error;
    }
}

$res = $mysqli->query("SELECT * FROM questions ORDER BY id ASC");
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Создадим тест на основе существующих вопросов</h3>
            <form action="?id=addtest" method="Post">
                <div class="form-group">
                    <label for="question">Введите название теста</label>
                    <textarea class="form-control" name="nametest" rows="1"></textarea>
                </div>

                <p>Список доступных вопросов</p>
                <?php
                for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
                    $res->data_seek($row_no);
                    $row = $res->fetch_assoc();
                    echo <<<QUESTIONS
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="questionid[]" value="$row[id]">
                    <label class="form-check-label" for="exampleCheck1">$row[question] ID: $row[id]</label>
                </div>

QUESTIONS;

                }
                ?>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
</div>
